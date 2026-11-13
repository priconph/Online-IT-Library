<meta name="csrf-token" content="{{ csrf_token() }}">

<button id="freezePC">Freeze PC</button>
<button id="unfreezePC">Unfreeze PC</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $("#freezePC").click(function() {
        $.post("api/toggle-freeze", { pc_name: "A-ISS-37-0919", status: true }, function() {
            alert("PC Frozen!");
        });
    });

    $("#unfreezePC").click(function() {
        $.post("api/toggle-freeze", { pc_name: "A-ISS-37-0919", status: false }, function() {
            alert("PC Unfrozen!");
        });
    });
</script>
