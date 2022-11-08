/**
 * Created by edwin on 11/7/15.
 */

$(document).ready(function() {
    $("#selectAllBoxes").click(function(event) {
        if (this.checked) {
            $(".checkBoxes").each(function() {
                this.checked = true;
            });
        } else {
            $(".checkBoxes").each(function() {
                this.checked = false;
            });
        }
    });

    /**************** User Profile **********************/

    var panels = $(".user-infos");
    var panelsButton = $(".dropdown-user");
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr("data-for");
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if (idFor.is(":visible")) {
                currentButton.html(
                    '<i class="glyphicon glyphicon-chevron-up text-muted"></i>'
                );
            } else {
                currentButton.html(
                    '<i class="glyphicon glyphicon-chevron-down text-muted"></i>'
                );
            }
        });
    });

    $('[data-toggle="tooltip"]').tooltip();

    //$('button').click(function(e) {
    //    e.preventDefault();
    //    alert("This is a demo.\n :-)");
    //});
    $(".btn-comment-reply").click(function() {
        $(".reply-form").css({
            height: "190px"
        });
    });
    $(document).ready(function() {
        $("#search").keyup(function() {
            var inputValue = $("#search").val();
            $("#serach-result").empty();
            $.get("/api/post/search/?q=" + inputValue, function(data, status) {
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {
                        $("#serach-result").append(
                            "<p><a href='/post/" +
                                data[i]["id"] +
                                "'>" +
                                data[i]["title"] +
                                "</a></p>"
                        );
                    }
                } else {
                    $("#serach-result").append("<p>Nothing Found!</p>");
                }
            });
        });
    });
});
