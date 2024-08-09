
        function submitForm() {
            var name = document.getElementById('input1').value;
            var email = document.getElementById('input2').value;
            var phone = document.getElementById('input3').value;
            var aadhar = document.getElementById('input4').value;

            // Send data to server using AJAX or fetch API
            fetch('save_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'input1=' + encodeURIComponent(name) +
                    '&input2=' + encodeURIComponent(email) +
                    '&input3=' + encodeURIComponent(phone) +
                    '&input4=' + encodeURIComponent(aadhar),
            })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Display response from server
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
  