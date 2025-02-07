
    <div class="pt-4">
        <h5>Job Preference</h5>
        <div class="form-group">
            <label for="job_type">Job Type</label>
            <select name="job_type" id="job_type" class="form-control">
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
            </select>
        </div>
        <div class="form-group">
            <label for="preferred_state">Preferred State</label>
            <input type="text" name="preferred_state" id="preferred_state"class="form-control">
        </div>
        <div class="form-group">
            <label for="preferred_city">Preferred city</label>
            <input type="text" name="preferred_city"id="preferred_city" class="form-control">
        </div>
        <div class="form-group">
            <label for="salary_range">Salary Range</label>
            <input type="text" name="salary_range" id="salary_range" class="form-control" readonly data-toggle="modal" data-target="#salaryModal">
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" name="department" id="department"class="form-control" readonly data-toggle="modal" data-target="#skillsModal">
        </div>
    </div>


<!-- Modal for selecting salary range -->
<div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="salaryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="salaryModalLabel">Select Salary Range</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="salaryForm">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary1" value="0-5000">
                        <label class="form-check-label" for="salary1">0-5000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary2" value="5000-10000">
                        <label class="form-check-label" for="salary2">5000-10000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary3" value="10000-20000">
                        <label class="form-check-label" for="salary3">10000-20000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary4" value="20000-30000">
                        <label class="form-check-label" for="salary4">20000-30000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary5" value="30000-40000">
                        <label class="form-check-label" for="salary5">30000-40000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary6" value="40000-50000">
                        <label class="form-check-label" for="salary6">40000-50000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary7" value="50000-60000">
                        <label class="form-check-label" for="salary7">50000-60000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="salary" id="salary8" value="60000-70000">
                        <label class="form-check-label" for="salary8">60000-70000</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSalary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for selecting skills -->
<div class="modal fade" id="skillsModal" tabindex="-1" role="dialog" aria-labelledby="skillsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skillsModalLabel">Select Skills</h5>
                <span id="skillCounter" class="ml-auto"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <span>Single Skill</span>
                    <label class="switch">
                        <input type="checkbox" id="skillModeToggle">
                        <span class="slider round"></span>
                    </label>
                    <span>Multiple Skills</span>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-kitchen-tab" data-toggle="pill" href="#v-pills-kitchen" role="tab" aria-controls="v-pills-kitchen" aria-selected="true">Kitchen</a>
                            <a class="nav-link" id="v-pills-frontoffice-tab" data-toggle="pill" href="#v-pills-frontoffice" role="tab" aria-controls="v-pills-frontoffice" aria-selected="false">Front Office</a>
                            <a class="nav-link" id="v-pills-bar-tab" data-toggle="pill" href="#v-pills-bar" role="tab" aria-controls="v-pills-bar" aria-selected="false">Bar/Restaurant</a>
                            <a class="nav-link" id="v-pills-spa-tab" data-toggle="pill" href="#v-pills-spa" role="tab" aria-controls="v-pills-spa" aria-selected="false">Spa/Health Club</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-kitchen" role="tabpanel" aria-labelledby="v-pills-kitchen-tab">
                                <button class="btn btn-outline-primary skill-btn" data-skill="Juice Maker">Juice Maker</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="CDP All Rounder">CDP All Rounder</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="Indian Cook (Punjabi)">Indian Cook (Punjabi)</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="Chinese Chef">Chinese Chef</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="Tandoor Chef">Tandoor Chef</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="South Indian Chef">South Indian Chef</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="Continental">Continental</button>
                            </div>
                            <div class="tab-pane fade" id="v-pills-frontoffice" role="tabpanel" aria-labelledby="v-pills-frontoffice-tab">
                                <button class="btn btn-outline-primary skill-btn" data-skill="Receptionist">Receptionist</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="Concierge">Concierge</button>
                                <!-- Add more front office sub-departments as needed -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-bar" role="tabpanel" aria-labelledby="v-pills-bar-tab">
                                <button class="btn btn-outline-primary skill-btn" data-skill="Bartender">Bartender</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="Waiter">Waiter</button>
                                <!-- Add more bar/restaurant sub-departments as needed -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-spa" role="tabpanel" aria-labelledby="v-pills-spa-tab">
                                <button class="btn btn-outline-primary skill-btn" data-skill="Spa Therapist">Spa Therapist</button>
                                <button class="btn btn-outline-primary skill-btn" data-skill="Health Club Instructor">Health Club Instructor</button>
                                <!-- Add more spa/health club sub-departments as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSkills">Save</button>
            </div>
        </div>
    </div>
</div>

<style>
    .skill-btn {
        margin: 5px;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
    }
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 12px;
        width: 12px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .slider {
        background-color: #2196F3;
    }
    input:checked + .slider:before {
        transform: translateX(14px);
    }
</style>

<script>
    $(document).ready(function() {
        var maxSkills = 5;
        var selectedSkills = [];
        var singleSkillMode = true;

        // Function to update the counter display
        function updateCounter() {
            var counterText = singleSkillMode ? `${selectedSkills.length}/1` : `${selectedSkills.length}/${maxSkills}`;
            $('#skillCounter').text(counterText);
        }

        $('#skillModeToggle').change(function() {
            singleSkillMode = !$(this).is(':checked');
            selectedSkills = [];
            $('.skill-btn').removeClass('active');
            updateCounter();
        });

        $('.skill-btn').click(function() {
            var skill = $(this).data('skill');
            if (singleSkillMode) {
                selectedSkills = [skill];
                $('.skill-btn').removeClass('active');
                $(this).addClass('active');
            } else {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    selectedSkills = selectedSkills.filter(s => s !== skill);
                } else {
                    if (selectedSkills.length < maxSkills) {
                        $(this).addClass('active');
                        selectedSkills.push(skill);
                    }
                }
            }
            updateCounter();
        });

        $('#saveSkills').click(function() {
            $('input[name="department"]').val(selectedSkills.join(', '));
            $('#skillsModal').modal('hide');
        });

        // Reset modal state when it's opened
        $('#skillsModal').on('show.bs.modal', function () {
            selectedSkills = [];
            $('.skill-btn').removeClass('active');
            $('input[name="department"]').val('');
            updateCounter();
        });

        // Add the counter display
        $('#skillsModal .modal-header').append('<span id="skillCounter" class="ml-auto"></span>');
        updateCounter();

        // Handle salary selection
        $('#saveSalary').click(function() {
            var selectedSalary = $('input[name="salary"]:checked').val();
            if (selectedSalary) {
                $('input[name="salary_range"]').val(selectedSalary);
                $('#salaryModal').modal('hide');
            }
        });

        // Reset salary modal state when it's opened
        $('#salaryModal').on('show.bs.modal', function () {
            $('input[name="salary"]').prop('checked', false);
        });
    });
</script>
