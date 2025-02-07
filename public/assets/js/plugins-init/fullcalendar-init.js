this.currentUser = currentUser;
this.users = usersList;
this.url = url;
this.events1 = events;
this.updateurl = updateurl;
this.deleteurl = updateurldelete;
this.comurl = comurl;
this.commenturl = commenturl;
this.token = token;

!(function (e) {
    "use strict";

    var t = function () {
        this.$body = e("body");
        this.$modal = e("#event-modal");
        this.$event = "#external-events div.external-event";
        this.$calendar = e("#calendar");
        this.$saveCategoryBtn = e(".save-category");
        this.$categoryForm = e("#add-category form");
        this.$extEvents = e("#external-events");
        this.$calendarObj = null;
        this.url = url; // Example: Set current user's name dynamically
        this.currentUser = currentUser; // Example: Set current user's name dynamically
        this.users = usersList; // Example: List of users for task assignment
    };
    // console.log(JSON.stringify(this.users));
    // Helper to create form fields dynamically
    t.prototype.createFormField = function (label, inputHtml) {
        return `
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">${label}</label>
                    ${inputHtml}
                </div>
            </div>
        `;
    };
    // Helper to create form fields dynamically
    t.prototype.createFormField2 = function (label, inputHtml) {
        return `
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">${label}</label>
                    ${inputHtml}
                </div>
            </div>
        `;
    };

    // Event Modal Form Builder
    t.prototype.createEventForm = function () {
        // Assign options for user dropdown
        const userOptions = this.users
            .map((user) => `<option value="${user}">${user}</option>`)
            .join("");

        // Define form fields
        const fields = [
            this.createFormField(
                "Task Name",
                `<input class="form-control" placeholder="Insert Task Name" type="text" name="title" />
                <input class="form-control d-none" placeholder="Insert Task Name" type="text" name="id" />
                `
            ),
            this.createFormField(
                "Category",
                `<select class="form-control" name="category">
                    <option value="bg-danger">Urgent</option>
                    <option value="bg-primary">Regular</option>
                    <option value="bg-dark">Very Urgent</option>
                    <option value="bg-warning">Warning</option>
                </select>`
            ),
            this.createFormField(
                "Assign To",
                `<select class="form-control" name="assign-to">${userOptions}</select>`
            ),
            this.createFormField(
                "Created By",
                `<input class="form-control" type="text"  value="${this.currentUser}" disabled />
                <input class="form-control d-none" type="text" name="created_by" value="${this.currentUser}"  />
               <br>
                Date
                <input class="form-control " type="text" id="date11" name="date" value=""  />
                `
            ),
            this.createFormField2(
                "Description",
                `<textarea class="form-control summernote" name="description"></textarea>
                <button class="btn btn-primary d-none" id="task_sub" name="submit" type="submit"></button>
                
                `
            ),
        ];

        return `<form  action=${this.url
            } method="post" enctype="multipart/form-data"><div class="row">${fields.join(
                ""
            )}</div></form>`;
    };

    // Event on time slot selection
    t.prototype.onSelect = function (start, end) {
        const o = this;
        o.$modal.modal({ backdrop: "static" });
        const date11 = start._d;
        // Populate the modal with the form
        const formHtml = o.createEventForm();
        o.$modal.find(".modal-body").empty().append(formHtml);
        o.$modal.find("#date11").val(date11);
        // Initialize Summernote for description
        o.$modal.find(".summernote").summernote();

        o.$modal.find(".delete-event").hide();
        o.$modal
            .find(".save-event")
            .show()
            .off("click")
            .on("click", function () {
                console.log("testfvxbvb clicked");
                o.$modal.find("#task_sub").trigger("click");

                o.$modal.find("form").submit();
            });

        // Form submission
        // o.$modal.find("form").on("submit", function (e) {
        //     e.preventDefault();

        //     const title = o.$modal.find("input[name='title']").val();
        //     const category = o.$modal.find("select[name='category']").val();
        //     const createdby = o.$modal.find("select[name='created_by']").val();
        //     const assignTo = o.$modal.find("select[name='assign-to']").val();
        //     const description = o.$modal.find(".summernote").val();

        //     if (!title) {
        //         alert("You must provide a title for the event.");
        //         return false;
        //     }

        //     o.$calendarObj.fullCalendar("renderEvent", {
        //         title: title,
        //         start: start,
        //         end: end,
        //         allDay: false,
        //         className: category,
        //         assignTo: assignTo,
        //         description: description,
        //         createdBy: o.currentUser,
        //     }, true);

        //     // o.$modal.modal("hide");
        //     return false;
        // });

        o.$calendarObj.fullCalendar("unselect");
    };

    // Event on clicking an existing event
    t.prototype.onEventClick = function (event) {
        const o = this;
        console.log("event",event);

        o.$modal.modal({ backdrop: "static" });

        if (event.createdBy === o.currentUser) {
            // Show form for updating
            const formHtml = o.createEventForm();
            o.$modal.find(".modal-body").empty().append(formHtml);

            // console.log("test",date11);
            // // Populate form with event data
            // o.$modal.find("#date11").val(date11);
            o.$modal.find("input[name='title']").val(event.title);
            o.$modal.find("input[name='id']").val(event.id);
            o.$modal.find("input[name='date']").val(event.start._i);
            o.$modal.find("textarea[name='description']").val(event.description);

            o.$modal.find("select[name='category']").val(event.className[0]);
            o.$modal.find("select[name='assign-to']").val(event.assignTo);
            // o.$modal.find(".summernote").summernote().code(event.description);

            o.$modal
                .find(".delete-event")
                .show()
                .off("click")
                .on("click", function () {
                    const formData = {
                        id: event.id,
                    };
                    // console.log(formData);
                    // Send data to the updateurl
                    $.ajax({
                        url: deleteurl, // Specify your update URL variable here
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            alert("Data Delete successfully:");
                            // Optionally refresh the calendar or perform any action here
                            o.$calendarObj.fullCalendar("refetchEvents");

                            // Close the modal
                            o.$modal.modal("hide");
                            window.location.reload();
                        },
                        error: function (error) {
                            console.error("Error delete data:", error);
                            alert("Failed to delete event. Please try again.");
                        },
                    });

                    // o.$modal.find("form").submit();
                });
            o.$modal
                .find(".save-event")
                .show()
                .off("click")
                .on("click", function () {
                    const formData = {
                        title: o.$modal.find("input[name='title']").val(),
                        id: event.id,
                        category: o.$modal.find("select[name='category']").val(),
                        date: o.$modal.find("input[name='date']").val(),
                        assignTo: o.$modal.find("select[name='assign-to']").val(),
                        description: o.$modal.find("textarea[name='description']").val(),
                    };
                    // console.log(formData);
                    // Send data to the updateurl
                    $.ajax({
                        url: updateurl, // Specify your update URL variable here
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            alert("Data updated successfully:");
                            // Optionally refresh the calendar or perform any action here
                            o.$calendarObj.fullCalendar("refetchEvents");

                            // Close the modal
                            o.$modal.modal("hide");
                            window.location.reload();
                        },
                        error: function (error) {
                            console.error("Error updating data:", error);
                            alert("Failed to update event. Please try again.");
                        },
                    });

                    // o.$modal.find("form").submit();
                });

            // o.$modal.find("form").on("submit", function (e) {
            //     e.preventDefault();

            //     event.title = o.$modal.find("input[name='title']").val();
            //     event.className = [o.$modal.find("select[name='category']").val()];
            //     event.createdBy = [o.$modal.find("select[name='created_by']").val()];
            //     event.assignTo = o.$modal.find("select[name='assign-to']").val();
            //     event.description = o.$modal.find(".summernote").val();

            //     o.$calendarObj.fullCalendar("updateEvent", event);
            //     o.$modal.modal("hide");
            //     return false;
            // });
        } else {
            // Show details for other users
            let detailsHtml = `
    <h5>Task Details</h5>
    <p><strong>Task Name:</strong> ${event.title}</p>
    <p><strong>Category:</strong> ${event.className[0]}</p>
    <p><strong>Assigned To:</strong> ${event.assignTo}</p>
    <p><strong>Created By:</strong> ${event.createdBy}</p>
    <p><strong>Description:</strong> ${event.description}</p>
    <div class="form-group">
        <label>Add Comment</label>
        <textarea class="form-control" placeholder="Add your comment" name="comment">${event.comment || ""
                }</textarea>
    </div>
`;

            // Add buttons conditionally based on the status
            if (event.status !== "complete") {
                detailsHtml += `
        <button class="btn btn-success mark-completed" id="mark_complet">Mark as Completed</button>
    `;
            } else {
                detailsHtml += `
        <button class="btn btn-success">Completed</button>
    `;
            }

            // Always include the update comments button
            detailsHtml += `
    <button class="btn btn-primary update_com" id="update_com">Update Comments</button>
`;

            o.$modal.find(".modal-body").html(detailsHtml);
            o.$modal.find(".save-event, .delete-event").hide();

            o.$modal
                .find(".mark-completed")
                .off("click")
                .on("click", function () {
                    alert("Task marked as completed!");
                    // o.$modal.modal("hide");
                    const formData = {
                        id: event.id,
                    };
                    // console.log(formData);
                    // Send data to the updateurl
                    $.ajax({
                        url: comurl, // Specify your update URL variable here
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            alert("Data updated successfully:");
                            // Optionally refresh the calendar or perform any action here
                            o.$calendarObj.fullCalendar("refetchEvents");

                            // Close the modal
                            o.$modal.modal("hide");
                            window.location.reload();
                        },
                        error: function (error) {
                            console.error("Error updating data:", error);
                            alert("Failed to update event. Please try again.");
                        },
                    });
                });
            o.$modal
                .find(".update_com")
                .off("click")
                .on("click", function () {
                    // alert("Task marked as completed!");
                    // o.$modal.modal("hide");
                    const formData = {
                        id: event.id,
                        comment: o.$modal.find("textarea[name='comment']").val(),
                    };
                    // console.log(formData);
                    // Send data to the updateurl
                    $.ajax({
                        url: commenturl, // Specify your update URL variable here
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            alert("Data updated successfully:");
                            // Optionally refresh the calendar or perform any action here
                            o.$calendarObj.fullCalendar("refetchEvents");

                            // Close the modal
                            o.$modal.modal("hide");
                            window.location.reload();
                        },
                        error: function (error) {
                            console.error("Error updating data:", error);
                            alert("Failed to update event. Please try again.");
                        },
                    });
                });
        }
    };

    // Enable Dragging for External Events
    t.prototype.enableDrag = function () {
        e(this.$event).each(function () {
            const eventObject = { title: e.trim(e(this).text()) };

            e(this).data("eventObject", eventObject).draggable({
                zIndex: 999,
                revert: true,
                revertDuration: 0,
            });
        });
    };

    // Initialize the Calendar
    t.prototype.init = function () {
        this.enableDrag();
        const o = this;
        // this.events1 = events;
        // Predefined events
        const events = events1 || [];

        // const events = [
        //     { title: "Task 1", start: new Date(), className: "bg-dark", createdBy: "John Doe", assignTo: "Jane Smith", description: "Complete the report." },
        //     { title: "Task 2", start: new Date(), className: "bg-danger", createdBy: "Jane Smith", assignTo: "John Doe", description: "Prepare presentation." },
        // ];
        console.log(events);
        // Initialize FullCalendar
        o.$calendarObj = o.$calendar.fullCalendar({
            editable: true,
            droppable: true,
            selectable: true,
            events: events,
            select: function (start, end) {
                o.onSelect(start, end);
            },
            eventClick: function (event) {
                o.onEventClick(event);
            },
        });

        // Add new category
        o.$saveCategoryBtn.on("click", function () {
            const categoryName = o.$categoryForm
                .find("input[name='category-name']")
                .val();
            const categoryColor = o.$categoryForm
                .find("select[name='category-color']")
                .val();
            if (categoryName) {
                o.$extEvents.append(`
                    <div class="external-event bg-${categoryColor}" data-class="bg-${categoryColor}">
                        <i class="fa fa-move"></i>${categoryName}
                    </div>
                `);
                o.enableDrag();
            }
        });
    };

    e.CalendarApp = new t();
    e.CalendarApp.Constructor = t;
})(window.jQuery),
    (function (e) {
        "use strict";
        e.CalendarApp.init();
    })(window.jQuery);
