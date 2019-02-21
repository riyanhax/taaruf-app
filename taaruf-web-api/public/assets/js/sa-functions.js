(function($, window, i) {
	// Bootstrap 4 Modal
	$.fn.fireModal = function(options) {
		var options = $.extend({
			size: 'modal-md',
			center: false,
			animation: true,
			title: 'Modal Title',
			closeButton: true,
			header: true,
			body: '',
			buttons: [],
			created: function() {},
			appended: function() {},
			modal: {}
		}, options);

		this.each(function() {
			i++;
			var id = 'fire-modal-' + i;

			$(this).off('click').on("click", function() {
				var modal_template = '   <div class="modal'+ (options.animation == true ? ' fade' : '') +'" tabindex="-1" role="dialog" id="'+ id +'">  '  + 
														 '     <div class="modal-dialog '+options.size+(options.center ? ' modal-dialog-centered' : '')+'" role="document">  '  + 
														 '       <div class="modal-content">  '  + 
														 ((options.header == true) ?
														 '         <div class="modal-header">  '  + 
														 '           <h5 class="modal-title">'+ options.title +'</h5>  '  + 
														 ((options.closeButton == true) ?
														 '           <button type="button" class="close" data-dismiss="modal" aria-label="Close">  '  + 
														 '             <span aria-hidden="true">&times;</span>  '  + 
														 '           </button>  '
														 : '') + 
														 '         </div>  '
														 : '') +
														 '         <div class="modal-body">  '  + 
														 options.body + 
														 '         </div>  '  +
														 (options.buttons.length > 0 ?
														 '         <div class="modal-footer">  '  + 
														 '         </div>  '  
														 : '')+ 
														 '       </div>  '  + 
														 '     </div>  '  + 
														 '  </div>  ' ; 

				modal_template = $(modal_template).modal(options.modal);
				var this_button;
				options.buttons.forEach(function(item) {
					this_button = '<button class="'+ item.class +'">'+ item.text +'</button>';
					this_button = $(this_button).off('click').on("click", function() {
						item.handler.call(this, modal_template);
					});
					$(modal_template).find('.modal-footer').append(this_button);
				});
				options.created.call(this, modal_template, options);

				$("body").append(modal_template);
				options.appended.call(this, id, options);
	
				return false;
			});
		});
	}

	// Bootstrap Modal Destroyer
	$.destroyModal = function(modal) {
		modal.modal('hide');
		modal.on('hidden.bs.modal', function() {
			modal.remove();
		});
	}

	// Card Progress Controller
	$.cardProgress = function(card, options) {
		var options = $.extend({
			dismiss: false,
			dismissText: 'Cancel',
			onDismiss: function() {}
		}, options);


		var me = $(card);

		me.addClass('card-progress');
		if(options.dismiss == true) {
			var btn_dismiss = '<a class="btn btn-danger card-progress-dismiss">'+options.dismissText+'</a>';
			btn_dismiss = $(btn_dismiss).off('click').on('click', function() {
				me.removeClass('card-progress');
				me.find('.card-progress-dismiss').remove();
				options.onDismiss.call(this, me);
			});
			me.append(btn_dismiss);
		}
	}

	$.cardProgressDismiss = function(card, dismissed) {
		var me = $(card);
		me.removeClass('card-progress');
		me.find('.card-progress-dismiss').remove();		
		if(dismissed)
			dismissed.call(this, me);
	}

	$.chatCtrl = function(element, chat) {
		var chat = $.extend({
			position: 'chat-right',
			text: '',
			time: moment(new Date().toISOString()).format('hh:mm'),
			picture: '',
			type: 'text', // or typing
			timeout: 0,
			onShow: function() {}
		}, chat);

		var target = $(element),
				element = '<div class="chat-item '+chat.position+'" style="display:none">' +
									'<img src="'+chat.picture+'">' +
									'<div class="chat-details">' +
									'<div class="chat-text">'+chat.text+'</div>' +
									'<div class="chat-time">'+chat.time+'</div>' +
									'</div>' +
									'</div>',
				typing_element = '<div class="chat-item chat-left chat-typing" style="display:none">' +
									'<img src="'+chat.picture+'">' +
									'<div class="chat-details">' +
									'<div class="chat-text"></div>' +
									'</div>' +
									'</div>';

			var append_element = element;
			if(chat.type == 'typing') {
				append_element = typing_element;
			}

			if(chat.timeout > 0) {
				setTimeout(function() {
					target.find('.chat-content').append($(append_element).fadeIn());
				}, chat.timeout);
			}else{
				target.find('.chat-content').append($(append_element).fadeIn());
			}

			var target_height = 0;
			target.find('.chat-content .chat-item').each(function() {
				target_height += $(this).outerHeight();
			});
			setTimeout(function() {
				target.find('.chat-content').scrollTop(target_height, -1);
			}, 100);
			chat.onShow.call(this, append_element);
	}
})(jQuery, this, 0);

