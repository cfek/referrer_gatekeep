$(function () {
  // getting the stored referrer from Drupal :: state()
  var stored_referrer = drupalSettings.referrer_gatekeep.referrer_gatekeep.red_target;
  var stored_referrer_message = drupalSettings.referrer_gatekeep.referrer_gatekeep.red_target_message;
  var actual_referrer = document.referrer;
  
  
  console.log(stored_referrer, actual_referrer);
  
  if (stored_referrer !== actual_referrer) {
    console.log('not equal');
  }

  if (stored_referrer == actual_referrer) {
    console.log('very equal');
  }
  
  if (actual_referrer === null) {
    alert('referrer is null');
  }
  
  if (actual_referrer === '') {
    alert('referrer is empty!');
  }

  if (actual_referrer.indexOf(window.location.origin) === -1) {
    alert('referrer indexOff');
  }


  if (
    (actual_referrer === null) ||
    (actual_referrer === '') ||
    (stored_referrer !== actual_referrer) ||
    (actual_referrer.indexOf(window.location.origin) === -1)
    ) {    
    alert('Waiting for redirect.');
    window.location.replace(stored_referrer);
    }
});
