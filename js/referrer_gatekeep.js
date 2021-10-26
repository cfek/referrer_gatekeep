$(function(){
  // getting the stored referrer from Drupal :: state()
    var stored_referrer = drupalSettings.referrer_gatekeep.referrer_gatekeep.red_target;
    var actual_referrer = document.referrer;
    console.log(stored_referrer,actual_referrer);
    if (actual_referrer === null && actual_referrer === "" &&
      stored_referrer !== actual_referrer &&
      actual_referrer.indexOf(window.location.origin) === -1)  {
      console.log(stored_referrer);
      alert("Waiting for redirect.");
      window.location.replace(stored_referrer);
    }
});
