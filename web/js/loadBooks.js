$(function() {
    var boekenStart = 5;
    $("#loadbooks").click( function(){
        var $_GET = {};

        document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
            function decode(s) {
                return decodeURIComponent(s.split("+").join(" "));
            }

            $_GET[decode(arguments[1])] = decode(arguments[2]);
        });
        $.ajax({
            type: 'post',
            url: 'includes/bits/loadbooks.php?q='+$_GET['q'],
            data: "boeken_start="+ boekenStart,
            dataType: 'html',
            success: function(response) {
                $("#boekenDiv").append(response);
                if(!response){
                    $("#loadbooks").remove();
                }
                boekenStart+=5;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Error: " + errorThrown); 
            } 
        });
    });
});