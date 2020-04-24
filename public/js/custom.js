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
        var data = getUserFormData();
        console.log(data);
        $.ajax({
            url: '/users',
            method: 'post',
            data: {data},
            success: function (res) {
                alert('User created successfully')
            }
        })
    });

    // Edit User
    $("#edit-user").click(function () {
        var id = $(this).attr('data-id');
        var data = getUserFormData();
        $.ajax({
            url: '/users/' + id,
            method: 'put',
            data: {data},
            success: function (res) {
               alert('User updated successfully')
            }
        })
    });


    let deletedUserId;

    $('.delete-user').click(function(){
        deletedUserId = $(this).attr('data-id');
    })

    // Edit User
    $("#delete-user").click(function () {
        $.ajax({
            url: '/users/' + deletedUserId,
            method: 'delete',
            success: function (res) {
                alert('User deleted successfully');
                $('#deleteUserModal').modal('hide');
                $('#user-'+deletedUserId).remove();
            }
        })
    });
})
