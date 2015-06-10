$(document).ready(function(){
	var contact = {
	message: null,
	init: function (){ 
	$('form#personal-form').on('submit', function (e) {
	var btn = $(this);
	var name=$('form#personal-form #inputname').val();
	var email=$('form#personal-form #inputemail').val();
	if(!contact.validate(name,email)){
		console.log('bad name or email');
		}else{
	$.ajax({
            type: 'POST',
	    cache: false,
            url: pw_script_vars.ajaxurl,
	    dataType: "json",
	    data: $('form#personal-form').serialize()+'&popupnonce='+pw_script_vars.popupnonce+'&action=form-submit',
	    crossDomain: true,
	    success: function mat(data) {
                console.log(data);
		switch(data.condition){
			case 'error':
				$('form#personal-form .form-group #show-answer').removeClass('hidden').empty()
                                .append('  Ой! Что-то пошло не так. Сервис не работает, попробуйте еще раз ');
				console.log(' error ');
				break
			case 'busted':
				$('form#personal-form .form-group #show-answer').removeClass('hidden').empty()
                                .append(' Закончился поверочный интервал! Пожалуйста, перезагрузите страницу и попробуйте еще раз. ');
                                console.log(' busted ');
                                break
			case 'invalid-email':
                               contact.message= 'Пожалуйста, укажите адрес электронной почты';
                        	$('form#personal-form #femail').addClass('has-warning').on('click',function(){
                                $(this).removeClass(' has-warning ');
                        	});  
                                break
			case 'empty':
                                $('form#personal-form .form-group #show-answer').removeClass('hidden').empty()
                                .append(' Пожалуйста, заполните все поля ');
                                console.log(' invalid-email ');
                                break
			case 'sent-successfully':
				$('form#personal-form .form-group #show-answer').removeClass('hidden').empty()
				.append(' Поздравляем! Вы выиграли скидку '+data.discount+'% ');
				console.log(' sent-successfully ');
				break
			case 'try-later':
				$('form#personal-form .form-group #show-answer').removeClass('hidden').empty()
                                .append(' Cпасибо за участие! Ваша скидка '+data.discount+'% ');
                                console.log(' try-later-: '+data.discount);
                                break	
		}
	    },
            error: function (result) {
    console.log('that something is wrong');
            }
         });
       }
	e.preventDefault();
    });
  },
	validate: function (name,email){
		if(!name){
			contact.message= 'Пожалуйста, укажите имя';
			$('form#personal-form #fname').addClass('has-warning').on('click',function(){
				$(this).removeClass('has-warning');
			});
		}
		if(!email){
			contact.message= 'Пожалуйста, укажите адрес электронной почты';
			$('form#personal-form #femail').addClass('has-warning').on('click',function(){
                                $(this).removeClass('has-warning');
                        });	
		}else{
			if (!contact.validateEmail(email)) {
				contact.message= 'Некорректный адрес электронной почты';
				$('form#personal-form #fname').addClass('has-warning').on('click',function(){
                                $(this).removeClass('has-warning');
                        });	
			}
		}
		if(contact.message!==null){
			contact.message=null;
			return false;
		}else{
			return true;
		}
	},
	validateEmail: function(email){
		var at = email.lastIndexOf("@");

                        // Make sure the at (@) sybmol exists and  
                        // it is not the first or last character
                        if (at < 1 || (at + 1) === email.length)
                                return false;

                        // Make sure there aren't multiple periods together
                        if (/(\.{2,})/.test(email))
                                return false;

                        // Break up the local and domain portions
                        var local = email.substring(0, at);
                        var domain = email.substring(at + 1);

                        // Check lengths
                        if (local.length < 1 || local.length > 64 || domain.length < 4 || domain.length > 255)
                                return false;

                        // Make sure local and domain don't start with or end with a period
                        if (/(^\.|\.$)/.test(local) || /(^\.|\.$)/.test(domain))
                                return false;

                        // we're just going to let them go through
                        if (!/^"(.+)"$/.test(local)) {
                                // It's a dot-string address...check for valid characters
                                if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
                                        return false;
                        }

                        // Make sure domain contains only valid characters and at least one period
                        if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
                                return false;

                        return true;
	
	}

 };
	 contact.init();
});



// align to center page popup-window
function centerModals(){
  $('.modal').each(function(i){
    var $clone = $(this).clone().css('display', 'block').appendTo('body');
    var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
    top = top > 0 ? top : 0;
    $clone.remove();
    $(this).find('.modal-content').css("margin-top", top);
  });
}
$('.modal').on('show.bs.modal', centerModals);
$(window).on('resize', centerModals);


//check first entrance on site;
$(window).load(function (){
	var cmodal={
	init: function(){
		var cookie=cmodal.readCookie("chance");
		if (cookie!=null && cookie=='seen'){return null;}
		var popup=$('#getchance');
			if (popup.length){
				cmodal.setCookie('chance','seen',1);
				popup.modal();
			}
	},
	setCookie: function(name,value,days) {
                if (days) {
                        var date = new Date();
                        date.setTime(date.getTime()+(days*24*60*60*1000));
                        var expires = "; expires="+date.toGMTString();
                }
                else var expires = "";
                document.cookie = name+"="+value+expires+"; path=/";
        },
        readCookie: function(name) {
                var nameEQ = name + "=";
		var all = document.cookie;
                var ca = all.split(';');
		for(var i=0;i < ca.length;i++) {
                        var c = ca[i];
                        while (c.charAt(0)==' ') {
				c = c.substring(1,c.length);
				}
                        if (c.indexOf(nameEQ) == 0){
				c=c.substring(nameEQ.length,c.length);
				return c;
			}
		}
                return null;
        }
	
	};
	setTimeout(cmodal.init, 2000);
});
