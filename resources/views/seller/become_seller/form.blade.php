<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mentor Application</title>
  <style>
    /* Reset & base */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9fafb;
      margin: 0;
      padding: 3rem 1rem;
      color: #2d3748;
    }

    form {
      max-width: 700px;
      margin: 0 auto;
      background: #ffffff;
      padding: 2.5rem 3rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      font-size: 1rem;
      line-height: 1.5;
    }

    h2 {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      color: #276749;
      /* Dark green */
      text-align: center;
      margin-bottom: 1rem;
      font-size: 1.9rem;
    }

    hr {
      border: none;
      border-top: 2px solid #48bb78;
      /* Medium green */
      margin: 1rem 0 2rem;
      opacity: 0.6;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem 2rem;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.4rem;
      color: #1a202c;
      /* Darker text */
      cursor: pointer;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    select,
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 0.55rem 0.75rem;
      font-size: 1rem;
      border: 1.5px solid #cbd5e0;
      border-radius: 6px;
      background-color: #fefefe;
      color: #2d3748;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      font-family: inherit;
      resize: vertical;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    select:focus,
    textarea:focus,
    input[type="file"]:focus {
      border-color: #38a169;
      box-shadow: 0 0 8px rgba(56, 161, 105, 0.5);
      outline: none;
      background-color: #fff;
    }

    input[type="file"] {
      padding: 0.35rem 0.75rem;
    }

    textarea {
      min-height: 60px;
    }

    .checkbox-group {
      grid-column: 1 / -1;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-top: 1rem;
    }

    .checkbox-group label {
      font-weight: 500;
      color: #2d3748;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    input[type="checkbox"] {
      width: 1.25rem;
      height: 1.25rem;
      cursor: pointer;
    }

    button[type="submit"] {
      margin-top: 2.5rem;
      width: 100%;
      background-color: #38a169;
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: 700;
      font-size: 1.15rem;
      padding: 0.85rem 1.2rem;
      cursor: pointer;
      box-shadow: 0 6px 15px rgba(56, 161, 105, 0.4);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    button[type="submit"]:hover,
    button[type="submit"]:focus {
      background-color: #2f855a;
      box-shadow: 0 8px 20px rgba(47, 133, 90, 0.6);
      outline: none;
    }

    /* Responsive */
    @media (max-width: 600px) {
      form {
        padding: 2rem 1.5rem;
      }

      .grid {
        grid-template-columns: 1fr !important;
        gap: 1rem 0;
      }
    }
  </style>
</head>

<body>

  <form action="{{route('seller.submitform')}}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    @if (session('success'))
    <script>
      Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '{{ session('success') }}',
      confirmButtonColor: '#3085d6',
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false
      });
    </script>
  @endif

    @if (session('error'))
    <script>
      Swal.fire({
      icon: 'error',
      title: 'Oops!',
      text: '{{ session('error') }}',
      confirmButtonColor: '#d33'
      });
    </script>
  @endif

    <h2>Become a Mentor</h2>
    <hr />

    <div class="grid">
      <div>
        <label for="first_name">First Name</label>
        <input id="first_name" type="text" name="first_name" required autocomplete="given-name" placeholder="Enter your firstname" />
      </div>
      
      <div>
        <label for="last_name">Last Name</label>
        <input id="last_name" type="text" name="last_name" required autocomplete="family-name" placeholder="Enter your lastname" />
      </div>
      

      <div>
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" required autocomplete="email" placeholder="Enter your email" />
      </div>

      <div>
        <label for="phone">Phone Number</label>
        <input id="phone" type="tel" name="phone" required autocomplete="tel" placeholder="Enter your phone number (+63)" />
      </div>

      <div>
        <label for="business_name">Specialization</label>
        <input id="business_name" type="text" name="business_name" required placeholder="Enter your service name" />
      </div>

      <div>
        <label for="country">Country / Region</label>
        <select id="country" name="country" required>
          <option value="" disabled selected>Select your country</option>
          <option value="ph">🇵🇭 Philippines</option>
          <option value="us">🇺🇸 United States</option>
          <option value="ca">🇨🇦 Canada</option>
          <option value="gb">🇬🇧 United Kingdom</option>
          <option value="au">🇦🇺 Australia</option>
          <option value="jp">🇯🇵 Japan</option>
          <option value="de">🇩🇪 Germany</option>
          <option value="fr">🇫🇷 France</option>
          <option value="in">🇮🇳 India</option>
          <option value="cn">🇨🇳 China</option>
        </select>
      </div>

      <div>
        <label for="business_address">Address</label>
        <textarea id="business_address" name="business_address" rows="1" required placeholder="Enter your business address"></textarea>
      </div>

      <div>
        <label for="payment_method">Preferred Payment Method</label>
        <select id="payment_method" name="payment_method" required>
          <option value="Gcash">Gcash</option>
        </select>
      </div>

      <div>
        <label for="business_certificate">Resume / Curriculum Vitae</label>
        <input id="business_certificate" type="file" name="business_certificate" accept=".pdf,.jpg,.png" required />
      </div>

      <div>
        <label for="music_plan">Music Plan/Lesson Sample</label>
        <input id="music_plan" type="file" name="music_plan" accept=".pdf,.jpg,.png" required />
      </div>

      <div>
        <label for="government_id">Upload Government-issued ID</label>
        <input id="government_id" type="file" name="government_id" accept=".pdf,.jpg,.png" required />
      </div>


      <div class="checkbox-group">
        <label>
          <input type="checkbox" name="agree_terms" required />
          I agree to the <a href="{{route('policies')}}"  rel="noopener noreferrer">terms and conditions</a>
        </label>        
        <label>
          <input type="checkbox" name="confirm_info" required />
          I confirm all information is accurate
        </label>
      </div>
    </div>

    <button type="submit">Submit Application</button>
  </form>

  <!-- Include SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>