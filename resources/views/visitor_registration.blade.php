<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visitor Registration Form</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts - Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 800px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            font-size: 1rem;
            color: #555;
        }

        .form-container label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            color: #333;
        }

        .form-container input:focus,
        .form-container select:focus,
        .form-container textarea:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .grid-cols-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <!-- Header Section -->
        <div class="form-header">
            <h1>Register Here</h1>
            <p>Fill in the form below to register as a visitor.</p>
        </div>

        <h2>Visitor Registration Form</h2>

        <form action="{{ route('visitor.store.public') }}" method="POST">
            @csrf
            @method('POST')

            <input type="hidden" name="form_token" value="{{ session('form_token', md5(uniqid())) }}">

            <!-- First and Last Name -->
            <div class="grid-cols-2">
                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required>
                </div>
                <div>
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <!-- Suffix -->
            <label for="suffix">Suffix</label>
            <select id="suffix" name="suffix" value="{{ old('suffix') }}" required>
                <option value="">Select Suffix</option>
                <option value="N/A">N/A.</option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
            </select>

            <!-- Gender -->
            <label for="gender">Gender</label>
            <select id="gender" name="gender" value="{{ old('gender') }}" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Non-binary">Non-binary</option>
                <option value="Prefer_not_to_say">Prefer not to say</option>
            </select>

            <!-- Birth Date -->
            <label for="birth_date">Birth Date</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>

            <!-- Age and Age Group -->
            <div class="grid-cols-2">
                <div>
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" placeholder="Enter Age" value="{{ old('age') }}" required>
                </div>
                <div>
                    <label for="age_group">Age Group</label>
                    <select id="age_group" name="age_group" value="{{ old('age_group') }}" required>
                        <option value="">Select Age Group</option>
                        <option value="Child(0-12)">Child (0-12)</option>
                        <option value="Teen(13-19)">Teen (13-19)</option>
                        <option value="Young_Adult(20-29)">Young Adult (20-29)</option>
                        <option value="Adult(30-59)">Adult (30-59)</option>
                        <option value="Senior(60+)">Senior (60+)</option>
                    </select>
                </div>
            </div>

            <!-- Address -->
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter Address" value="{{ old('address') }}" required>

            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>

            <!-- Phone Number -->
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number') }}" required>

            <!-- Interests -->
            <label for="interests">Interests</label>
            <input type="text" id="interests" name="interests" placeholder="Enter Interests" value="{{ old('interests') }}" required>

            <!-- Contact Preference -->
            <label for="contact_preference">Contact Preference</label>
            <select id="contact_preference" name="contact_preference" value="{{ old('contact_preference') }}" required>
                <option value="">Select Preference</option>
                <option value="Email">Email</option>
                <option value="Phone">Phone_Number</option>
                <option value="No_Preference">No_Preference</option>
            </select>

            <!-- Interaction History -->
            <label for="interaction_history">Interaction History</label>
            <select id="interaction_history" name="interaction_history" value="{{ old('interaction_history') }}" required>
                <option value="">Select Interaction</option>
                <option value="Event">Event</option>
                <option value="Church_Service">Church Service</option>
                <option value="Online">Online</option>
                <option value="In_Person">In Person</option>
            </select>

            <!-- Invitation Source -->
            <label for="invitation_source">Invitation Source</label>
            <select id="invitation_source" name="invitation_source" value="{{ old('invitation_source') }}" required>
                <option value="">Select Invitation Source</option>
                <option value="Friend">Friend</option>
                <option value="Social_Media">Social Media</option>
                <option value="Website">Website</option>
                <option value="Flyer">Flyer</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        // Form submission expiration logic
        document.querySelector('form').addEventListener('submit', function () {
            this.querySelector('button[type="submit"]').disabled = true;
            this.querySelector('button[type="submit"]').textContent = "Submitting...";
        });
    </script>

</body>
</html>
