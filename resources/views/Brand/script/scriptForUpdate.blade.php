<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    // In your Javascript (Select2)
    $("#catagoryId").select2({
        placeholder: "Select a Catagory",
        allowClear: true
    });

    function ajaxFun() {
        brandName = document.getElementById('brandName');
        catagoryId = document.getElementById('catagoryId');

        brandName = brandName.value;
        catagoryId = catagoryId.value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ajaxValidation").innerHTML = this.responseText;
                if (this.responseText == "Already Exit") {
                    // document.getElementById('brandName').value = "";
                    document.getElementById("updatedbrandBtn").disabled = true;

                } else {
                    document.getElementById("updatedbrandBtn").disabled = false;

                }
            }
        };
        var url = "{{ url('ajax-validation-brand') }}";
        serverpage = url + "/" + brandName + "/" + catagoryId;
        xhttp.open("GET", serverpage, true);
        xhttp.send();
    }


    //Check Form Button Submit Validation
    $(document).ready(function() {
        $("#updatedbrandBtn").click(function() {
            brandName = document.getElementById('brandName');
            catagoryId = document.getElementById('catagoryId');

            brandName = brandName.value;
            catagoryId = catagoryId.value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("ajaxValidation").innerHTML = this.responseText;
                    if (this.responseText == "Already Exit") {
                        // document.getElementById('brandName').value = "";
                        document.getElementById("updatedbrandBtn").disabled = true;

                    } else {
                        document.getElementById("updatedbrandBtn").disabled = false;
                        $('form#updatedFormId').submit();

                    }
                }
            };
            var url = "{{ url('ajax-validation-brand') }}";
            serverpage = url + "/" + brandName + "/" + catagoryId;
            xhttp.open("GET", serverpage, true);
            xhttp.send();

        });
    });

</script>
