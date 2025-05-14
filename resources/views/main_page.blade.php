<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('registration-form');
        const resultContainer = document.getElementById('form-messages');

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            resultContainer.innerHTML = '';

            const formData = new FormData(form);

            try {
                const userResponse = await fetch('{{ route('user.create') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const userData = await userResponse.json();

                if (!userResponse.ok) {
                    if (userData.errors) {
                        for (const field in userData.errors) {
                            userData.errors[field].forEach(msg => {
                                const p = document.createElement('p');
                                p.style.color = 'red';
                                p.textContent = msg;
                                resultContainer.appendChild(p);
                            });
                        }
                    } else {
                        resultContainer.innerHTML = `<p style="color: red;">${userData.message || 'An error occurred.'}</p>`;
                    }
                    return;
                }

                const token = userData.access_token;
                localStorage.setItem('jwt_token', token);

                const linkResponse = await fetch('{{ route('unique_link.create') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                });

                const linkData = await linkResponse.json();

                if (!linkResponse.ok) {
                    resultContainer.innerHTML = `<p style="color: red;">${linkData.message || 'Error creating link.'}</p>`;
                    return;
                }

                window.location.href = linkData.unique_link;

            } catch (err) {
                console.error(err);
                resultContainer.innerHTML = `<p style="color: red;">Please, try again later.</p>`;
            }
        });
    });
</script>


<div style="text-align: center;">
    <form id="registration-form" style="margin: 50px auto; display: inline-grid; margin-block-end: 0;">
        @csrf
        <label>
            Name: <input type="text" name="user_name" placeholder="Name">
        </label>
        <br>
        <label>
            Phone: <input type="text" name="phone_number" placeholder="Phone">
        </label>
        <br>
        <button type="submit">Register</button>
    </form>

    <div id="form-messages"></div>
</div>