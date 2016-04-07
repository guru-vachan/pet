<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Plan Title</td>
            <td class="center"><?php echo $planDetail['User']['plan_title']; ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td class="center"><?php echo $planDetail['User']['last_name']; ?></td>

        </tr>
        <tr>
            <td>Email</td>
            <td class="center"><?php echo $planDetail['User']['email']; ?></td>

        </tr>
        <tr>
            <td>Date registered</td>
            <td class="center"><?php echo $this->Time->format($planDetail['User']['created'], '%B %e, %Y %H:%M %p'); ?></td>

        </tr>
        <tr>
            <td>Status</td>
            <td class="center"><?php echo ($planDetail['User']['status'] == 1) ? 'Active' : 'Inactive'; ?></td>

        </tr>
    </tbody>
</table>

