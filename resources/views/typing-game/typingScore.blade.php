<x-layout>
    <div class="highscore-container">
        <h1>Typing Game Highscores</h1>
        <br>
        <select id="highscoreModeSelect" onchange="filterHighscores()">
            <option value="all">All</option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
            <option value="hardcore">HardCore</option>
        </select>
        <br>
        <table class="highscore-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Difficulty</th>
                    <th>Time (seconds)</th>
                </tr>
            </thead>
            <tbody id="highscoreTableBody">
                @foreach($highscores as $index => $score)
                    <tr data-difficulty="{{ $score->difficulty }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $score->user->name }}</td>
                        <td>{{ ucfirst($score->difficulty) }}</td>
                        <td>{{ $score->time_seconds }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.filterHighscores = function () {
                const select = document.getElementById('highscoreModeSelect');
                const tbody = document.getElementById('highscoreTableBody');
                if (!select || !tbody) return;

                const rows = Array.from(tbody.querySelectorAll('tr'));
                const mode = select.value;
                let rank = 1;

                rows.forEach(row => {
                    const rowDifficulty = (row.getAttribute('data-difficulty') || '').toLowerCase();

                    if (mode === 'all' || rowDifficulty === mode.toLowerCase()) {
                        row.style.display = '';
                        const rankCell = row.querySelector('td');
                        if (rankCell) rankCell.textContent = rank++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            };

            filterHighscores();
        });
    </script>
</x-layout>