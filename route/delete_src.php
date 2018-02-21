<<<<<<< HEAD
=======
<?php require "../loginChecker.php"; ?>

>>>>>>> 433af9c52ccd5fa8649a8d7de447871ae1df4675
<!DOCTYPE html>
<html lng="eng">
    <head>
        <title>DELETE ROUTE</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div>
            <input type="text" id="deleteID" placeholder="Route ID" require>
            <button type="" id="deleteB">Delete</button>
        </div>
    </body>
</html>
<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#deleteB").on("click", function(){
            var route_id = $(this).prev().val();
            var data = {route_id:route_id};
            $.ajax({
				url: "delete.php",
				type: "POST",
				data: data,
				success: function(ret){
                    alert(ret);
                }	
			});
        });
    });
</script>
