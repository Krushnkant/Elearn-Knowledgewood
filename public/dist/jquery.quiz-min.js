/*!
 * jquery-quiz v0.0.1 - A simple jQuery quiz plugin.
 * Copyright (c) 2021 JC Hamill - http://jchamill.github.com/jquery-quiz/
 * License: MIT
 */

! function (z, v) {
    "use strict";
    z.quiz = function (t, e) {
        var o = this;
        o.$el = z(t), o.$el.data("quiz", o), o.options = z.extend(z.quiz.defaultOptions, e);
        var queResultArr = [];
        var count, interval;
        var timerSec = 90;
        var userid = o.options.userId;
        var courseid = o.options.courseId;
        var assessmentid = o.options.assessmentId;
        var apiUrl = o.options.apiUrl;
        var usertoken = o.options.usertoken;
        var baseUrl = o.options.baseUrl;
        var s = o.options.questions,
            u = s.length,
            i = o.options.startScreen,
            n = o.options.startButton,
            r = o.options.homeButton,
            a = o.options.resultsScreen,
            c = o.options.gameOverScreen,
            d = o.options.nextButtonText,
            l = o.options.finishButtonText,
            h = o.options.restartButtonText,
            q = 1,
            p = 0,
            f = !1;
        o.methods = {
            init: function () {
                o.methods.setup(), z(v).on("click", n, function (t) {
                    t.preventDefault(), o.methods.start(), o.methods.startCounter()
                }), z(v).on("click", r, function (t) {
                    t.preventDefault(), o.methods.home()
                }), z(v).on("click", ".answers a", function (t) {
                    t.preventDefault(), o.methods.answerQuestion(this), o.methods.endCounter()
                }), z(v).on("click", "#quiz-next-btn", function (t) {
                    t.preventDefault(), o.methods.nextQuestion(), o.methods.endCounter(), o.methods.startCounter()
                }), z(v).on("click", "#quiz-finish-btn", function (t) {
                    t.preventDefault(), o.methods.finish()
                }), z(v).on("click", "#quiz-restart-btn, #quiz-retry-btn", function (t) {
                    t.preventDefault(), o.methods.restart()
                })
            },
            startCounter: function () {
                $("#play-iconbox").html('<i class="bi bi-pause-circle-fill"></i>');
                count = timerSec;
                interval = setInterval(function () {
                    document.getElementById('count').innerHTML = count;
                    count--;

                    if (count === 0) {
                        $("#quiz-next-btn").trigger("click");
                        count = timerSec;
                        document.getElementById('count').innerHTML = count;
                    }
                }, 1000);
            },
            endCounter: function () {
                $("#play-iconbox").html('<i class="bi bi-play-circle-fill"></i>');
                clearInterval(interval);
            },
            setup: function () {
                var i = "";
                i += '<div class="d-flex flex-1">',
                    i += '<div class="tests-content-left">',
                    i += '<div class="tests-header" id="quiz-start-screen">',
                    i += '<div class="text-center">',
                    i += '<button type="button" id="quiz-start-btn" class="quiz-button button">Start</button>',
                    i += "</div>",
                    i += "</div>",
                    o.options.counter && (i += '<div id="quiz-counter" class="tests-header"></div>'),
                    i += '<div id="questions" class="tests-body">',
                    z.each(s, function (t, e) {
                        // console.log('t: ' + t);
                        // console.log('e: ' + e);
                        var qid = e.qId;
                        var optno = 'A';
                        var corIndex = e.corIndex;
                        queResultArr.push({
                            'questionId': qid,
                            'myAnswerId': 0,
                            'currectAns': ''
                        });
                        i += '<div class="question-container">',
                            i += '<div class="question">',
                            i += '<b>' + e.q + "</b>",
                            i += '</div>',
                            i += '<div class="row answers">',
                            z.each(e.options,
                                function (opt, e) {
                                    i += '<div class="col-md-6 col-sm-6"><a href="#" class="ans-option" data-index="' + opt + '" data-qid="' + qid + '" data-optid="' + e.optsId + '"><div class="ans-option-number">' + optno + '.</div>' + e.optsTxt + '</a></div>';
                                    // console.log('opt: ' + opt + ' | corIndex: ' + corIndex);
                                    if (opt === corIndex) queResultArr[t].currectAns = e.optsId;
                                    optno = String.fromCharCode(optno.charCodeAt() + 1);
                                }),
                            i += "</div>",
                            i += "</div>"
                    }),
                    0 === z(a).length && (
                        i += '<div id="' + a.substr(1) + '" class="pb-2 text-center">',
                        i += '<h3 id="quiz-results"></h3>',
                        i += '<div class="spinnder-box">',
                        i += '<span class="spinner-border text-secondary" role="status" aria-hidden="true" style="margin-right: 10px;"></span> Generating Your Mock test Report',
                        i += '</div>',
                        i += "</div>"),
                    i += '<div id="quiz-controls" class="pt-3">',
                    // i += '<p id="quiz-response" class="quiz-response"></p>',
                    i += '<div id="quiz-buttons">',
                    i += '<a href="#" id="quiz-next-btn" class="button countButton">' + d + "</a>",
                    i += "</div>",
                    i += "</div>",
                    i += "</div>",
                    i += "</div>",
                    i += '<div id="timer-box" class="tests-content-right" style="display: none;">',
                    i += '<div class="tests-guideline">',
                    i += '<h5 class="orange-title mb-3">Explanations:</h5>',
                    i += '<p id="quiz-response"></p>',
                    i += "  </div>",
                    i += '<div class="tests-content-timing">',
                    i += '<span id="play-iconbox" class="time-stop-btn"></span>';
                i += '<div class="tests-timing">',
                    i += '<img src="' + baseUrl + 'img/stop-watch.svg"> ',
                    i += '<span id="count" class="count">90</span> &nbsp; secs remaining',
                    i += "</div>",
                    i += "</div>",
                    i += "</div>",
                    i += "</div>",
                    i += '<div id="finish-control-box" class="content-bottom" style="display: none;">',
                    i += '<a href="#" id="quiz-finish-btn" class="button">' + l + "</a>",
                    i += '<a href="#" id="quiz-restart-btn" class="button">' + h + "</a>",
                    i += "</div>",
                    o.$el.append(i).addClass("quiz-container quiz-start-state"),
                    z("#quiz-counter").hide(),
                    z(".question-container").hide(),
                    z(c).hide(),
                    z(a).hide(),
                    z("#quiz-controls").hide(),
                    "function" == typeof o.options.setupCallback && o.options.setupCallback()
            },
            start: function () {
                o.$el.removeClass("quiz-start-state").addClass("quiz-questions-state"), z(i)
                    .hide(), z("#quiz-controls").show(), z("#quiz-next-btn").show(), z("#timer-box").show(), z("#finish-control-box").show(), z("#quiz-finish-btn").show(), z(
                        "#quiz-restart-btn").hide(), z("#questions").show(), z("#quiz-counter")
                            .show(), z(".question-container:first-child").show().addClass(
                                "active-question"), o.methods.updateCounter();
            },
            answerQuestion: function (t) {
                if (!f) {
                    f = !0;
                    var e = z(t),
                        i = "",
                        n = e.data("index"),
                        t = q - 1;
                    var ansId = e.data("optid");
                    var queId = e.data("qid");
                    var objIndex = queResultArr.findIndex((obj => obj.questionId == queId));
                    queResultArr[objIndex].myAnswerId = ansId;
                    /*queResultArr.push({
                        'questionId': queId,
                        'myAnswerId': ansId
                    });*/
                    if (n === s[t].corIndex)
                        e.addClass("correct"), i = s[t].correctResponse, p++;
                    else if (e.addClass("incorrect"), i = s[t].incorrectResponse, !o.options.allowIncorrect)
                        return void o.methods.gameOver(i);

                    q++ === u && (z("#quiz-next-btn").show(), z("#finish-control-box").show(), z("#quiz-finish-btn").show()), z(
                        "#quiz-response").html(i), z("#quiz-controls").fadeIn(), "function" ==
                        typeof o.options.answerCallback && o.options.answerCallback(q, n, s[t])
                }
            },
            nextQuestion: function () {
                // alert('Test');
                if (!f) {
                    q++;
                }
                f = !1, z(".active-question").hide().removeClass("active-question").next(
                    ".question-container").show().addClass("active-question"), z(
                        "#quiz-controls").show(), o.methods.updateCounter(), z("#quiz-response").html(''), "function" ==
                        typeof o.options.nextCallback && o.options.nextCallback()

            },
            gameOver: function (t) {
                var e;
                0 === z(c).length && (e = "", e += '<div id="' + c.substr(1) + '">', e +=
                    '<p id="quiz-gameover-response"></p>', e +=
                    '<p><a href="#" id="quiz-retry-btn">' + h + "</a></p>", o.$el.append(e +=
                        "</div>")), z("#quiz-gameover-response").html(t), z("#quiz-counter")
                            .hide(), z("#questions").hide(), z("#finish-control-box").show(), z("#quiz-finish-btn").show(), z(c).show()
            },
            finish: function () {

                var settings = {
                    "url": apiUrl,
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + usertoken,
                        "Content-Type": "application/json"
                    },
                    "data": JSON.stringify({ "course_id": courseid, "assessment_id": assessmentid, "user_id": userid, "my_answers": JSON.stringify(queResultArr) }),
                };

                $.ajax(settings).done(function (response) {
                    console.log(response);
                    var stringifyJson = JSON.stringify(response);
                    var responseData = JSON.parse(stringifyJson);
                    var isSuccess = responseData.success;
                    var message = responseData.message;

                    if (isSuccess == true) {
                        var testId = responseData.mock_test_id;
                        window.location.href = baseUrl + 'testReport/' + testId;
                    }
                });

                o.$el.removeClass("quiz-questions-state").addClass("quiz-results-state"),
                    z(".active-question").hide().removeClass("active-question"),
                    z("#quiz-counter").hide(),
                    z("#quiz-response").hide(),
                    z("#quiz-next-btn").hide(),
                    z("#finish-control-box").hide(),
                    z("#quiz-finish-btn").hide(),
                    z("#quiz-restart-btn").hide(),
                    z("#timer-box").hide(),
                    z(a).show();

                var t = o.options.resultsFormat.replace("%score", p).replace("%total", u);

                z("#quiz-results").html(t),
                    "function" == typeof o.options.finishCallback && o.options.finishCallback()
            },
            restart: function () {
                o.methods.reset(), o.$el.addClass("quiz-questions-state"), z("#questions").show(),
                    z("#quiz-counter").show(), z(".question-container:first-child").show()
                        .addClass("active-question"), o.methods.updateCounter()
            },
            reset: function () {
                f = !1, q = 1, p = 0, z(".answers a").removeClass("correct incorrect"), o.$el
                    .removeClass().addClass("quiz-container"), z("#quiz-restart-btn").hide(), z(c)
                        .hide(), z(a).hide(), z("#quiz-controls").hide(), z("#quiz-response").show(),
                    z("#quiz-next-btn").show(), z("#quiz-counter").hide(), z(".active-question")
                        .hide().removeClass("active-question"), "function" == typeof o.options
                            .resetCallback && o.options.resetCallback()
            },
            home: function () {
                o.methods.reset(), o.$el.addClass("quiz-start-state"), z(i).show(), "function" ==
                    typeof o.options.homeCallback && o.options.homeCallback()
            },
            updateCounter: function () {

                var t = o.options.counterFormat.replace("%current", q).replace("%total", u);
                z("#quiz-counter").html('<h6>Question:</h6><h5 class="orange-title mb-0">' + t + '</h5>')
            }
        }, o.methods.init()
    }, z.quiz.defaultOptions = {
        allowIncorrect: !0,
        counter: !0,
        counterFormat: "%current/%total",
        startScreen: "#quiz-start-screen",
        startButton: "#quiz-start-btn",
        homeButton: "#quiz-home-btn",
        resultsScreen: "#quiz-results-screen",
        resultsFormat: "You got %score out of %total correct!",
        gameOverScreen: "#quiz-gameover-screen",
        nextButtonText: "Next",
        finishButtonText: "Submit Test",
        restartButtonText: "Restart"
    }, z.fn.quiz = function (t) {
        return this.each(function () {
            new z.quiz(this, t)
        })
    }
}(jQuery, (window, document));