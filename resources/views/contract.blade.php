<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mentor Contract Agreement - ConnectingNotes</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            max-width: 900px;
            width: 100%;
        }

        .top-bar {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .home-button {
            padding: 10px 20px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .home-button:hover {
            background-color: #1a252f;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
        }

        h1,
        h2 {
            text-align: center;
            color: #2c3e50;
        }

        .section {
            margin-top: 30px;
        }

        .section h3 {
            margin-bottom: 10px;
            color: #1a252f;
        }

        .content {
            margin-left: 20px;
        }

        .signature-section {
            margin-top: 50px;
        }

        .signature-line {
            margin: 30px 0;
            border-bottom: 1px solid #999;
            width: 300px;
        }

        .signature-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .footer-note {
            text-align: center;
            margin-top: 60px;
            color: #888;
            font-size: 0.9em;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="top-bar">
            <a href="/" class="home-button">← Back to Home</a>
            <button onclick="downloadPDF()" class="home-button" style="margin-left: 10px;">⬇ Download PDF</button>

        </div>

        <div class="card">
            <h1>ConnectingNotes</h1>
            <h2>Mentor Contract Agreement</h2>

            <div class="section">
                <h3>1. Parties</h3>
                <div class="content">
                    This agreement is made between:
                    <ul>
                        <li><strong>ConnectingNotes</strong>, a web-based platform facilitating mentorship in music.
                        </li>
                        <li><strong>Mentor Name:</strong> [Insert Full Name]</li>
                        <li><strong>Effective Date:</strong> April 12, 2025</li>
                    </ul>
                </div>
            </div>

            <div class="section">
                <h3>2. Scope of Services</h3>
                <div class="content">
                    Mentor agrees to provide music instruction, guidance, and mentorship to students enrolled in
                    ConnectingNotes through scheduled sessions.
                </div>
            </div>

            <div class="section">
                <h3>3. Term and Termination</h3>
                <div class="content">
                    <ul>
                        <li>This agreement begins on the effective date and continues unless terminated by either party.
                        </li>
                        <li>Either party may terminate the contract with a 14-day written notice.</li>
                        <li>Breach of terms may result in immediate termination.</li>
                    </ul>
                </div>
            </div>

            <div class="section">
                <h3>4. Compensation</h3>
                <div class="content">
                    <ul>
                        <li>Mentor will receive payment based on the agreed rate per session.</li>
                        <li>Payouts are processed bi-weekly/monthly (as applicable) through the platform's payment
                            gateway.</li>
                        <li>Mentor is responsible for managing their own taxes and income declarations.</li>
                    </ul>
                </div>
            </div>

            <div class="section">
                <h3>5. Confidentiality</h3>
                <div class="content">
                    The Mentor agrees not to disclose any confidential information about students, session content, or
                    the ConnectingNotes platform.
                </div>
            </div>

            <div class="section">
                <h3>6. Intellectual Property</h3>
                <div class="content">
                    All content created and shared by the Mentor during sessions remains their intellectual property
                    unless otherwise agreed in writing.
                </div>
            </div>

            <div class="section">
                <h3>7. Dispute Resolution</h3>
                <div class="content">
                    Any disputes will first be attempted to be resolved through mutual discussion. If unresolved, the
                    matter may be elevated to mediation.
                </div>
            </div>

            <div class="section">
                <h3>8. Agreement</h3>
                <div class="content">
                    By signing this contract, the Mentor acknowledges understanding and acceptance of all terms.
                </div>
            </div>

            <div class="signature-section">
                <div class="signature-label">Mentor Signature:</div>
                <div class="signature-line"></div>
                <div class="signature-label">Date:</div>
                <div class="signature-line"></div>

                <div class="signature-label">ConnectingNotes Representative:</div>
                <div class="signature-line"></div>
                <div class="signature-label">Date:</div>
                <div class="signature-line"></div>
            </div>

           
        </div>
    </div>

</body>

</html>

<script>
    function downloadPDF() {
        const element = document.querySelector('.card');
        const opt = {
            margin: 0.5,
            filename: 'mentor_contract_agreement.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
  