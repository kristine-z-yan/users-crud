$.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
$(document).ready(function() {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
        if (this.checked) {
            checkbox.each(function () {
                this.checked = true;
            });
        } else {
            checkbox.each(function () {
                this.checked = false;
            });
        }
    });
    checkbox.click(function () {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });

    // Set inputs value from storage
    $('.form-single').each((index, item) => {
        if (sessionStorage.getItem($(item).attr('name'))) {
            if (!item.value || item.value == '0') item.value = sessionStorage.getItem($(item).attr('name'));
        }
    });

    // Set roles value from storage
    if (sessionStorage.getItem('roles[]')) {
        if (!$('.form-multiple').val()) {
            $.each(sessionStorage.getItem('roles[]').split(","), function(i,e){
                $(".form-multiple option[value='" + e + "']").prop("selected", true);
            });
        }
    }


    function getUserFormData() {
        var firstName = $('#first-name').val();
        var lastName = $('#last-name').val();
        var email = $('#email').val();
        var countryId = $('#country').val();
        var roles = $('#roles').val();
        return {
            'first_name': firstName,
            'last_name': lastName,
            'email': email,
            'country_id': countryId,
            'roles': roles,
        };
    }

    // Create User
    $("#create-user").click(function () {

        sessionStorage.clear();

        // For ajax
        // var data = getUserFormData();
        // console.log(data);
        // $.ajax({
        //     url: '/',
        //     method: 'post',
        //     data: {data},
        //     success: function (res) {
        //         alert('User created successfully')
        //     }
        // })
    });

    // Edit User
    $("#edit-user").click(function () {

        sessionStorage.clear();

        // var id = $(this).attr('data-id');
        // var data = getUserFormData();
        // $.ajax({
        //     url: '/' + id,
        //     method: 'put',
        //     data: {data},
        //     success: function (res) {
        //        alert('User updated successfully')
        //     }
        // })
    });

    let deletedUserId;

    $('.delete-user').click(function(){
        deletedUserId = $(this).attr('data-id');
    })

    // Edit User
    $("#delete-user").click(function () {
        $.ajax({
            url: '/' + deletedUserId,
            method: 'delete',
            success: function (res) {
                alert('User deleted successfully');
                $('#deleteUserModal').modal('hide');
                $('#user-'+deletedUserId).remove();
            }
        })
    });

    $('.form-control').on('change keyup', function() {
        sessionStorage.setItem($(this).attr('name'), $(this).val());
        if ($(this.parentElement).hasClass('has-error')) {
            $(this.parentElement).removeClass('has-error');
            $('.help-block',this.parentElement).remove();
        }
    })
})
