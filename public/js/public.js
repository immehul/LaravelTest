(function ($, window, document, undefined) {
    $(function () {
        //Event for add new row for technologies
        $(document).on('click', ".btn-add-tech", function() {

            var total_tech_row = $('.tech-row').length;

            if(total_tech_row < 5) {
                var html = '';
                //Call the function for adding new technologies row
                html = addNewRow();

                //append technologies row
                $('#wrapper-add-tech-row').append(html);
            } else {
                alert('You can add maximum 5 technologies');
            }
        });

        //create the event to store the temporary information
        $(document).on('click', ".btn-add-tech11", function(e) {
            e.preventDefault();   
            var formData = $('.rfpForm').not('input[type!="hidden"]').serialize();
            var actionUrl = $(this).attr('href');
            
            $.ajax({
                url : tempInfoUrl,
                type : 'POST',
                data : formData,
                dataType: 'json',
                success : function(response) {
                    if(response.status == 'success') {
                        location.href = actionUrl;
                    }
                }
            });
        });
    });

})(jQuery, Window, document);

/*This function is useful for creating new row technologies row*/
function addNewRow()
{
    var html = '<div class="form-group row tech-row">\
            <label for="tech_name" class="col-md-4 col-form-label text-md-right">Technologies</label>\
                <div class="col-md-6">\
                    <input id="tech_name" type="text" class="form-control @error("tech_name") is-invalid @enderror" name="tech_name[]" value="" required>\
                </div>\
        </div>';

    return html;
}