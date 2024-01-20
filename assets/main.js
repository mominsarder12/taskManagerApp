document.addEventListener("DOMContentLoaded", function () {
	var successMessage = document.getElementById("success-message");

	if (successMessage) {
		successMessage.style.display = "block";

		setTimeout(function () {
			successMessage.style.display = "none";
		}, 5000);

		var closeBtn = successMessage.querySelector(".close-btn");

		closeBtn.onclick = function () {
			successMessage.style.display = "none";
		};
	}
});
function closeSuccessMessage() {
	var successMessage = document.getElementById("success-message");
	successMessage.style.display = "none";
}

// const completeBtnAll = document.querySelectorAll(".complete");
// const completeId = document.querySelectorAll("#complete_id");
// const completeForm = document.querySelectorAll("#complete_form");
// completeBtnAll.forEach((completeBtn) => {
// 	completeBtn.addEventListener("click", function () {
// 		let id = this.dataset.task_id;
// 		//alert(id);
// 		completeId.value(id);
// 		completeForm.submit();
// 	});
// });

//for mark as complete tasks
const completeBtnAll = document.querySelectorAll(".complete");
const completeId = document.querySelector("#task_id");
const completeForm = document.querySelector("#complete-form");
completeBtnAll.forEach((completeBtn) => {
	completeBtn.addEventListener("click", function () {
		let id = this.dataset.task_id;
		completeId.value = id;
		completeForm.submit();
	});
});

//for mark as incomplete tasks
const inCompleteBtnAll = document.querySelectorAll(".incomplete");
const inCompleteTaskId = document.querySelector("#incomplete_task_id");
const inCompleteForm = document.querySelector("#incomplete-form");
inCompleteBtnAll.forEach((inCompleteBtn) => {
	inCompleteBtn.addEventListener("click", function () {
		let id = this.dataset.incomplete_task_id;
		inCompleteTaskId.value = id;
		inCompleteForm.submit();
	});
});

//for delete tasks
const deleteBtnAll = document.querySelectorAll(".delete");
const deleteTaskId = document.querySelector("#delete_task_id");
const deleteForm = document.querySelector("#delete-form");

deleteBtnAll.forEach((deleteBtn) => {
    deleteBtn.addEventListener("click", function () {
        let id = this.dataset.delete_task_id;
        if (confirm("Are you sure you want to delete the task with ID " + id + "?")) {
            deleteTaskId.value = id;
            deleteForm.submit();
        }
    });
});

