!function($){function a(a,e){var r=0,o=0;"gpa"===a&&(o=4,r=2.5),("reading"===a||"math"===a)&&(o=800,r=200),"act"===a&&(o=36,r=11),e&&(r>e||e>o)?$("#correction-"+a).show():$("#correction-"+a).hide()}function e(){if($(".gpa input").val().length>1&&(2===$(".act input").val().length||3===$(".reading input").val().length&&3===$(".math input").val().length)){var a=0,e=400*$("input#gpa").val(),r=$("input#reading").val(),o=$("input#math").val(),s=parseFloat(r)+parseFloat(o),n=$("input#act").val();switch(""!==r&&""!==o&&(a=parseFloat(r)+parseFloat(o)+parseFloat(e)),n){case"36":n=1600;break;case"35":n=1580;break;case"34":n=1520;break;case"33":n=1470;break;case"32":n=1420;break;case"31":n=1380;break;case"30":n=1340;break;case"29":n=1300;break;case"28":n=1260;break;case"27":n=1220;break;case"26":n=1180;break;case"25":n=1140;break;case"24":n=1110;break;case"23":n=1070;break;case"22":n=1030;break;case"21":n=990;break;case"20":n=950;break;case"19":n=910;break;case"18":n=870;break;case"17":n=830;break;case"16":n=780;break;case"15":n=740;break;case"14":n=680;break;case"13":n=620;break;case"12":n=560;break;case"11":n=500}null!==n&&parseFloat(n)+parseFloat(e)>a&&(a=parseFloat(n)+parseFloat(e)),$("#UAA").length?a>=2750?document.getElementById("awardlevel").innerHTML="<h2>Congratulations!</h2><h3>You are eligible for $4000.</h3><p>Your strong academic record may also qualify you for additional awards from the University's 700-plus scholarship programs. If you haven't already done so, please  apply for  <a href=\"https://www.applyweb.com/wsunivss/index.ftl\">admission and scholarships</a>.</p>":a>=2400?document.getElementById("awardlevel").innerHTML="<h2>Congratulations!</h2><h3>You are eligible for $2000.</h3><p>Your good academic record may also qualify you for additional awards from the University's 700-plus scholarship programs. If you haven't already done so, please  apply for  <a href=\"https://www.applyweb.com/wsunivss/index.ftl\">admission and scholarships</a>.</p>":2400>a&&(document.getElementById("awardlevel").innerHTML="<strong>Based on the scores you provided, you do not qualify for the University Achievement Award.</strong> <p>If your scores change, please calculate your eligibility again. You may qualify for other awards from the University's 700-plus scholarship programs. If you haven't already done so, please apply for  <a href=\"https://www.applyweb.com/wsunivss/index.ftl\">admission and scholarships</a>.</p>"):$("#CAA").length?a>=2400?document.getElementById("awardlevel").innerHTML="<h2>Congratulations!</h2> <h3>You are eligible for <strong>$11,000</strong> in your first year, renewable for up to three additional years.</h3> <p>Your good academic record may also qualify you for additional awards from the University's 700-plus scholarship programs. If you haven't already done so, please apply for  <a href=\"https://www.applyweb.com/wsunivss/index.ftl\">admission and scholarships</a>.</p>":2400>a&&(document.getElementById("awardlevel").innerHTML="<strong>Based on the scores you provided, you do not qualify for the Cougar Freshman Academic Award.</strong> <p>If your scores change, you may use this calculator again to see if you are eligible. You may qualify for other awards from the University's 700-plus scholarship programs. If you haven't already done so, please apply for  <a href=\"https://www.applyweb.com/wsunivss/index.ftl\">admission and scholarships</a>.</p>"):$("#CC").length?a>=2200?document.getElementById("awardlevel").innerHTML='<h2>Congratulations!</h2> <p>Your good academic record indicates you\'re eligible for the Crimson Crew program provided you also: <br>1) Have a college preparatory curriculum <br>2) Positive grade trends <br>3) <a href="https://www.applyweb.com/wsunivss/index.ftl">Apply</a> to the WSU Pullman campus</p>':2200>a&&(document.getElementById("awardlevel").innerHTML="<p>Based on the information you provided, it does not appear you're eligible for the Crimson Crew program at this time.</p> <h2>But wait!</h2> <p>That doesn't mean you're not eligible for admission. Discuss further with your admission counselor at <a href=\"http://rep.wsu.edu\">rep.wsu.edu</a>.</p>"):document.getElementById("awardlevel").innerHTML=""}else document.getElementById("awardlevel").innerHTML=""}$(document).ready(function(){$(".gpa input").on("change",function(){var e=$(".gpa input").val();a("gpa",e)}),$(".math input").on("change",function(){var e=$(".math input").val();a("math",e)}),$(".reading input").on("change",function(){var e=$(".reading input").val();a("reading",e)}),$(".act input").on("change",function(){var e=$(".act input").val();a("act",e)}),$("#calculator input").on("keyup",function(){e()})})}(jQuery);