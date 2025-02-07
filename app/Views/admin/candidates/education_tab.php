
    <div class="pt-4">
        <h5>Education</h5>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="ten_th" id="tenth_pass">
            <label class="form-check-label" for="tenth_pass">10th Pass</label>
            <div class="mt-2 education-details" id="tenth_details" style="display: none;">
                <input type="text" class="form-control" name="ten_school" placeholder="School Name"id="ten_school">
                <input type="text" class="form-control mt-2" name="ten_year" placeholder="Year" id="ten_year">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="to_th" id="twelfth_pass">
            <label class="form-check-label" for="twelfth_pass">12th Pass</label>
            <div class="mt-2 education-details" id="twelfth_details" style="display: none;">
                <input type="text" class="form-control" name="to_th_school" id="to_th_school" placeholder="School Name">
                <input type="text" class="form-control mt-2" name="to_th_year" id="to_th_year" placeholder="Year">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="gra_dip" id="graduate">
            <label class="form-check-label" for="graduate">Graduate/Diploma</label>
            <div class="mt-2 education-details" id="graduate_details" style="display: none;">
                <input type="text" class="form-control" name="gr_university"id="gr_university" placeholder="College/University Name">
                <input type="text" class="form-control mt-2" name="gr_degree"id="gr_degree" placeholder="Degree name">
                <input type="text" class="form-control mt-2" name="gr_year"id="gr_year" placeholder="Year">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="post_gra" id="post_graduate">
            <label class="form-check-label" for="post_graduate">Post Graduation</label>
            <div class="mt-2 education-details" id="post_graduate_details" style="display: none;">
                <input type="text" class="form-control" name="pg_university"id="pg_university" placeholder="College/University Name">
                <input type="text" class="form-control mt-2" name="pg_degree" id="pg_degree"placeholder="Degree name">
                <input type="text" class="form-control mt-2" name="pg_year" id="pg_year"placeholder="Year">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="doc" id="doctorate">
            <label class="form-check-label" for="doctorate">Doctorate</label>
            <div class="mt-2 education-details" id="doctorate_details" style="display: none;">
                <input type="text" class="form-control" name="doc_university"id="doc_university" placeholder="College/University Name">
                <input type="text" class="form-control mt-2" name="doc_degree"id="doc_degree" placeholder="Degree name">
                <input type="text" class="form-control mt-2" name="doc_year"id="doc_year" placeholder="Year">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="hotel_de" id="hotel_management">
            <label class="form-check-label" for="hotel_management">Do you have a degree in Hotel Management?</label>
            <div class="mt-2 education-details" id="hotel_management_details" style="display: none;">
                <input type="text" class="form-control" name="h_college" id="h_college"placeholder="College/University Name">
                <input type="text" class="form-control mt-2" name="h_year"id="h_year" placeholder="Year">
            </div>
        </div>
    </div>


<script>
    $(document).ready(function() {
        // Function to toggle visibility of education details based on checkbox status
        function toggleEducationDetails(checkboxId, detailsId) {
            $('#' + checkboxId).change(function() {
                if ($(this).is(':checked')) {
                    $('#' + detailsId).show();
                } else {
                    $('#' + detailsId).hide();
                }
            });
        }

        // Apply the function to all education checkboxes
        toggleEducationDetails('tenth_pass', 'tenth_details');
        toggleEducationDetails('twelfth_pass', 'twelfth_details');
        toggleEducationDetails('graduate', 'graduate_details');
        toggleEducationDetails('post_graduate', 'post_graduate_details');
        toggleEducationDetails('doctorate', 'doctorate_details');
        toggleEducationDetails('hotel_management', 'hotel_management_details');
    });
</script>
