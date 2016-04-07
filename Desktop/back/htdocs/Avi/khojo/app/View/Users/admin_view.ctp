<table class="table table-bordered">
    <tbody>
        <tr>
            <td>First Name</td>
            <td class="center"><?php echo $userDetail['User']['first_name']; ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td class="center"><?php echo $userDetail['User']['last_name']; ?></td>

        </tr>
        <tr>
            <td>Email</td>
            <td class="center"><?php echo $userDetail['User']['email']; ?></td>

        </tr>
        <tr>
            <td>Date registered</td>
            <td class="center"><?php echo $this->Time->format($userDetail['User']['created'], '%B %e, %Y %H:%M %p'); ?></td>

        </tr>
        <tr>
            <td>Status</td>
            <td class="center"><?php echo ($userDetail['User']['status'] == 1) ? 'Active' : 'Inactive'; ?></td>

        </tr>
    </tbody>
</table>

