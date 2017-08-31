/**
 * Created by david on 29/08/17.
 */
$(document).ready(function() {
    $(".loader").click(function () {
        displayLoader(this);
    });

    function displayLoader(elem) {
        $("#loader").toggle();
        $(elem).toggle();
    }
});