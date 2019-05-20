$(function () {
    $('button.delete').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteModal = $("#deleteMealModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteModal.find('input[name=id]').val(link.dataset.id);
        // open modal
        document.getElementById("deleteMealModal").style.display = "block";
    });
});


$(function () {
    $('button.restore').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteModal = $("#restoreMealModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteModal.find('input[name=id]').val(link.dataset.id);
        // open modal
        document.getElementById("restoreMealModal").style.display = "block";
    });
    
});

$(function () {
    $('button.volAcc').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteModal = $("#acceptVolunteerModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteModal.find('input[name=accVol]').val(link.dataset.id);
        // open modal
        document.getElementById("acceptVolunteerModal").style.display = "block";
    });
});

$(function () {
    $('button.volRej').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteModal = $("#rejectVolunteerModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteModal.find('input[name=rejVol]').val(link.dataset.id);
        // open modal
        document.getElementById("rejectVolunteerModal").style.display = "block";
    });
});

$(function () {
    $('button.volDelete').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteVolModal = $("#deleteVolunteerModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteVolModal.find('input[name=delVol]').val(link.dataset.id);
        // open modal
        document.getElementById("deleteVolunteerModal").style.display = "block";
    });
});


$(function () {
    $('button.volRestore').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var restoreVolModal = $("#restoreVolunteerModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        restoreVolModal.find('input[name=resVol]').val(link.dataset.id);
        // open modal
        document.getElementById("restoreVolunteerModal").style.display = "block";
    });
    
});

$(function () {
    $('button.deleteAdmin').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteModal = $("#deleteAdminModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteModal.find('input[name=id]').val(link.dataset.id);
        // open modal
        document.getElementById("deleteAdminModal").style.display = "block";
    });
});

$(function () {
    $('button.changePermission').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteModal = $("#changePermissionModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteModal.find('input[name=change]').val(link.dataset.id);
        // open modal
        document.getElementById("changePermissionModal").style.display = "block";
    });
});


$(function () {
    $('button.change').click(function (e) {
        // open modal
        document.getElementById("changePasswordModal").style.display = "block";

        $('#oldPassword, #confirmPassword').on('keyup', function () {
            if ($('#oldPassword').val() == $('#confirmPassword').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else 
                $('#message').html('Not Matching').css('color', 'red');
        });
    });
});


$(function () {
    $('button.volunteer').click(function (e) {
        e.preventDefault();
        //grab specific button that was pressed
        var link = this;
        var deleteModal = $("#volunteerModal");
        // store the ID of meal idea, taken from button, inside the modal's form
        deleteModal.find('input[name=id]').val(link.dataset.id);
        // open modal
        document.getElementById("volunteerModal").style.display = "block";
    });
});

function addAdminModal() {
    document.getElementById("addAdminModal").style.display = "block";
}

function addDateModal() {
    document.getElementById("addDateModal").style.display = "block";
}

function removeDateModal() {
    document.getElementById("removeDateModal").style.display = "block";
}

function addSuperUserModal() {
    document.getElementById("addSuperUserModal").style.display = "block";
}

$(function () {
    $('a.signOut').click(function (e) {
        document.getElementById("signOutModal").style.display = "block";
    });
});

function closeChangePasswordModal() {
    document.getElementById("changePasswordModal").style.display = "none";
}

function closeRestoreModal() {
    document.getElementById("restoreMealModal").style.display = "none";
}

function closeDeleteModal() {
    document.getElementById("deleteMealModal").style.display = "none";
}

function closeSignOutModal() {
    document.getElementById("signOutModal").style.display = "none";
}

function closeAddAdminModal() {
    document.getElementById("addAdminModal").style.display = "none";
}

function closeAddSuperUserModal() {
    document.getElementById("addSuperUserModal").style.display = "none";
}

function closeDeleteAdminModal() {
    document.getElementById("deleteAdminModal").style.display = "none";
}

function closeChangePermissionModal() {
    document.getElementById("changePermissionModal").style.display = "none";
}

function closeAddDateModal() {
    document.getElementById("addDateModal").style.display = "none";
}

function closeRemoveDateModal() {
    document.getElementById("removeDateModal").style.display = "none";
}

function closeVolunteerModal() {
    document.getElementById("volunteerModal").style.display = "none";
}

function closeDeleteVolunteerModal(){
    document.getElementById("deleteVolunteerModal").style.display = "none";
}

function closeRestoreVolunteerModal(){
    document.getElementById("restoreVolunteerModal").style.display = "none";
}

function closeAcceptVolunteerModal(){
    document.getElementById("acceptVolunteerModal").style.display = "none";
}

function closeRejectVolunteerModal(){
    document.getElementById("rejectVolunteerModal").style.display = "none";
}