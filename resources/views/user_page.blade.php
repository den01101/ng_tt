<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const code = window.location.pathname.split('/')[1];
        const token = localStorage.getItem('jwt_token');
        const buttons = document.getElementById('buttons');
        const resultContainer = document.getElementById('result-container');
        const historyContainer = document.getElementById('history-container');

        if (!token) {
            window.location.href = '/';
            return;
        }

        try {
            const url = '{{ route('unique_link.state', ['code' => ':code']) }}'.replace(':code', code);
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            });

            if (!response.ok) {
                buttons.remove();
                resultContainer.innerHTML = `<p style="color: red;">Unauthorized</p>`;
            }

            const data = await response.json();

            if (!data.is_active) {
                buttons.remove();
                resultContainer.innerHTML = `<p style="color: red;">Your link is expired or deactivated</p>`;
            }

        } catch (error) {
            buttons.remove();
            resultContainer.innerHTML = `<p style="color: red;">Access denied</p>`;
        }

        const newLinkButton = document.getElementById('new-link');
        const disableLinkButton = document.getElementById('disable-link');
        const getLuckyButton = document.getElementById('get-lucky');
        const historyButton = document.getElementById('history');

        newLinkButton.addEventListener('click', async function (e) {
            e.preventDefault();

            const response = await fetch('{{ route('unique_link.create') }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            });

            const data = await response.json();

            if (!response.ok) {
                resultContainer.innerHTML = `<p style="color: red;">${data.message || 'Error creating link.'}</p>`;
                return;
            }

            window.location.href = data.unique_link;
        });

        disableLinkButton.addEventListener('click', async function (e) {
            e.preventDefault();

            const url = '{{ route('unique_link.deactivate', ['code' => ':code']) }}'.replace(':code', code);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            });

            const data = await response.json();

            if (!response.ok) {
                resultContainer.innerHTML = `<p style="color: red;">${data.message || 'Error deactivating link.'}</p>`;
                return;
            }

            window.location.reload();
        });

        getLuckyButton.addEventListener('click', async function (e) {
            e.preventDefault();

            const url = '{{ route('get_lucky', ['code' => ':code']) }}'.replace(':code', code);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            });

            const data = await response.json();

            if (!response.ok) {
                resultContainer.innerHTML = `<p style="color: red;">${data.message || 'Something wrong.'}</p>`;
                return;
            }

            let color = 'red';

            if (data.win) {
                color = 'green';
            }

            const message = 'Your ' + (data.win ? 'win $' + data.amount : 'lose') + ' number is : ' + data.number;

            historyContainer.innerHTML = '';
            resultContainer.innerHTML = `<p style="color: ${color};">${message}</p>`;
        });

        historyButton.addEventListener('click', async function (e) {
            e.preventDefault();

            const url = '{{ route('history', ['code' => ':code']) }}'.replace(':code', code);
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            });

            const data = await response.json();

            if (!response.ok) {
                resultContainer.innerHTML = `<p style="color: red;">${data.message || 'Something wrong.'}</p>`;
                return;
            }

            let rows = '<p>History is empty</p>';

            if (data.length > 0) {
                rows = '<p>History:</p>';

                data.forEach((row) => {
                    let color = 'red';

                    if (row.win) {
                        color = 'green';
                    }

                    rows += '<p style="color: ' + color + ';">Number: ' + row.number + ' you ' + (row.win ? 'win $' + row.amount : 'lose') + '</p>';
                });
            }

            resultContainer.innerHTML = '';
            historyContainer.innerHTML = rows;
        });
    });
</script>

<div style="text-align: center; margin-top: 30px;">
    <div id="buttons">
        <button type="submit" id="new-link">New link</button>
        <button type="submit" id="disable-link">Disable current link</button>
        <button type="submit" id="get-lucky">I'm feeling lucky</button>
        <button type="submit" id="history">History</button>
    </div>

    <div id="result-container"></div>

    <div id="history-container"></div>
</div>

