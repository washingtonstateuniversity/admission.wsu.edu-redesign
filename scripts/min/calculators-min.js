!function($){function a(a,e){var r=0,o=0;"gpa"===a&&(o=4,r=2.5),("reading"===a||"math"===a)&&(o=800,r=200),"act"===a&&(o=36,r=11),e&&(r>e||e>o)?$("#correction-"+a).show():$("#correction-"+a).hide()}function e(){if(document.getElementById("gpa").value&&(document.getElementById("reading").value&&document.getElementById("math").value||document.getElementById("act").value)){var a=0,e=400*$("input#gpa").val(),r=$("input#reading").val(),o=$("input#math").val(),s=parseFloat(r)+parseFloat(o),t=$("input#act").val();switch(""!==r&&""!==o&&(a=parseFloat(r)+parseFloat(o)+parseFloat(e)),t){case"36":t=1600;break;case"35":t=1580;break;case"34":t=1520;break;case"33":t=1470;break;case"32":t=1420;break;case"31":t=1380;break;case"30":t=1340;break;case"29":t=1300;break;case"28":t=1260;break;case"27":t=1220;break;case"26":t=1180;break;case"25":t=1140;break;case"24":t=1110;break;case"23":t=1070;break;case"22":t=1030;break;case"21":t=990;break;case"20":t=950;break;case"19":t=910;break;case"18":t=870;break;case"17":t=830;break;case"16":t=780;break;case"15":t=740;break;case"14":t=680;break;case"13":t=620;break;case"12":t=560;break;case"11":t=500}null!==t&&parseFloat(t)+parseFloat(e)>a&&(a=parseFloat(t)+parseFloat(e)),$("body").hasClass("page-university-achievement-award")?a>=2750?document.getElementById("awardlevel").innerHTML="<h2>Congratulations!</h2><h3>You are eligible for $4000.</h3><p>Your strong academic record may also qualify you for additional awards from the University's 700-plus scholarship programs. If you haven't already done so, please  apply for  <a href=\"http://admission.wsu.edu/applications/apply.html#scholarships\">admission and scholarships</a>.</p>":a>=2400?document.getElementById("awardlevel").innerHTML="<h2>Congratulations!</h2><h3>You are eligible for $2000.</h3><p>Your good academic record may also qualify you for additional awards from the University's 700-plus scholarship programs. If you haven't already done so, please  apply for  <a href=\"http://admission.wsu.edu/applications/apply.html#scholarships\">admission and scholarships</a>.</p>":2400>a&&(document.getElementById("awardlevel").innerHTML="<strong>Based on the scores you provided, you do not qualify for the University Achievement Award.</strong> <p>If your scores change, please calculate your eligibility again. You may qualify for other awards from the University's 700-plus scholarship programs. If you haven't already done so, please apply for  <a href=\"http://admission.wsu.edu/applications/apply.html#scholarships\">admission and scholarships</a>.</p>"):$("body").hasClass("page-cougar-academic-award")?a>=2500?document.getElementById("awardlevel").innerHTML="<h2>Congratulations!</h2> <h3>You are eligible for <strong>$11,000</strong> in your first year, renewable for up to three additional years.</h3> <p>Your strong academic record may also qualify you for additional awards from the University's 700-plus scholarship programs. If you haven't already done so, please apply for  <a href=\"http://admission.wsu.edu/applications/apply.html#scholarships\">admission and scholarships</a>.</p>":a>=2400?document.getElementById("awardlevel").innerHTML="<h2>Congratulations!</h2> <h3>You are eligible for <strong>$4000</strong> in your first year, renewable for up to three additional years.</h3> <p>Your good academic record may also qualify you for additional awards from the University's 700-plus scholarship programs. If you haven't already done so, please apply for  <a href=\"http://admission.wsu.edu/applications/apply.html#scholarships\">admission and scholarships</a>.</p>":2400>a&&(document.getElementById("awardlevel").innerHTML="<strong>Based on the scores you provided, you do not qualify for the Cougar Freshman Academic Award.</strong> <p>If your scores change, you may use this calculator again to see if you are eligible. You may qualify for other awards from the University's 700-plus scholarship programs. If you haven't already done so, please apply for  <a href=\"http://admission.wsu.edu/applications/apply.html#scholarships\">admission and scholarships</a>.</p>"):$("body").hasClass("page-cougar-commitment")?a>=2200?document.getElementById("awardlevel").innerHTML='<h2>Congratulations!</h2> <p>Your good academic record indicates you\'re eligible for the Crimson Crew program provided you also: <br>1) Have a college preparatory curriculum <br>2) Positive grade trends <br>3) <a href="http://admission.wsu.edu/applications/index.html">Apply</a> to the WSU Pullman campus</p>':2200>a&&(document.getElementById("awardlevel").innerHTML="<p>Based on the information you provided, it does not appear you're eligible for the Crimson Crew program at this time.</p> <h2>But wait!</h2> <p>That doesn't mean you're not eligible for admission. Discuss further with your admission counselor at <a href=\"http://rep.wsu.edu\">rep.wsu.edu</a>.</p>"):document.getElementById("awardlevel").innerHTML=""}}$(document).ready(function(){$(".gpa input").on("change",function(){var e=$(".gpa input").val();a("gpa",e)}),$(".math input").on("change",function(){var e=$(".math input").val();a("math",e)}),$(".reading input").on("change",function(){var e=$(".reading input").val();a("reading",e)}),$(".act input").on("change",function(){var e=$(".act input").val();a("act",e)}),$("#calculator input").on("change",function(){e()})})}(jQuery);