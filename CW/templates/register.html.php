<h2>Register New Account</h2>

<?php if (isset($output) && $output) echo $output; ?>

<form action="" method="post">
    <p>
        <label for="name">User Name:</label><br>
        <input type="text" name="name" id="name" required style="width: 350px; padding: 12px; font-size: 16px;">
    </p>
    <p>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required style="width: 350px; padding: 12px; font-size: 16px;">
    </p>
    <p>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required style="width: 350px; padding: 12px; font-size: 16px;">
    </p>
    <p>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required style="width: 350px; padding: 12px; font-size: 16px;">
    </p>
    
    <!-- Nút Create Account đã ngắn gọn và căn giữa -->
    <p style="text-align: center; margin-top: 20px;">
        <input type="submit" value="Create Account" 
               style="padding: 12px 50px; background: #00a400; color: white; border: none; 
                      border-radius: 6px; cursor: pointer; font-size: 17px; 
                      box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    </p>
</form>