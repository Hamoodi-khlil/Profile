</div> <!-- col10-->

</div> <!-- row -->

<script src="<?php echo $directory; ?>/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {


        $('#fullScreenBtn').click(function() {
            $('#sidebar').toggleClass("d-none");
            $('#content').toggleClass("col-10 col-12");
        });

    });
</script>

</body>

</html>