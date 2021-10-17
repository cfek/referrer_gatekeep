$(function(){


    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/drupal/web/referrer.txt", false);
    xhttp.send();
    console.log(xhttp.responseText);
    var stored_referrer = xhttp.responseText;
    var actual_referrer = document.referrer;
    console.log(actual_referrer);
    if (actual_referrer !== null && actual_referrer !== "" &&
      stored_referrer !== actual_referrer &&
      actual_referrer.indexOf(window.location.origin) === -1) {
      alert("Waiting for redirect.");
      window.location.replace(stored_referrer);
    }
});
