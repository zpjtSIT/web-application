<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Upload images to server using Node JS</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    
</head>
<body>
    <form id="frmUploader" enctype="multipart/form-data" action="http://ict2103group12.tk:3000/fault" method="post">
        <input type="text" name="data" id="data">
        <input type="file" name="faultimage" multiple />
        <input type="submit" name="submit" id="btnSubmit" value="Upload" />
    </form>
</body>

<script>
        $(document).ready(function () {
            var options = {
                beforeSubmit: showRequest,  // pre-submit callback
                success: showResponse  // post-submit callback
            };

            // bind to the form's submit event
            $('#frmUploader').submit(function () {
                $(this).ajaxSubmit(options);
                // always return false to prevent standard browser submit and page navigation
                return false;
            });
        });

        // pre-submit callback
        function showRequest(formData, jqForm, options) {
            alert('Uploading is starting.');
            return true;
        }

        // post-submit callback
        function showResponse(responseText, statusText, xhr, $form) {
            alert('status: ' + statusText + '\n\nresponseText: \n' + responseText );
        }
    </script>

</html>
