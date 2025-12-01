<x-layout>
    <div class="typing-highscore-container">
        <h1>Typing Game Highscores</h1>
        <br>

        <select id="highscoreModeSelect" onchange="filterHighscores()" class="difficulty-select">
            <option value="all">All</option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
            <option value="hardcore">HardCore</option>
        </select>

        <br><br>

        <table class="typing-highscore-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Difficulty</th>
                    <th>WPM</th>
                    <th>Time (s)</th>
                </tr>
            </thead>

            <tbody id="highscoreTableBody">
                @foreach($highscores as $index => $score)
                    <tr data-difficulty="{{ strtolower($score->difficulty) }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $score->user->name }}</td>
                        <td>{{ ucfirst($score->difficulty) }}</td>
                        <td>{{ $score->wpm }}</td>
                        <td>{{ $score->time_seconds }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.filterHighscores = function () {
                const mode = document.getElementById('highscoreModeSelect').value;
                const rows = document.querySelectorAll('#highscoreTableBody tr');
                let rank = 1;

                rows.forEach(row => {
                    const rowDiff = row.getAttribute('data-difficulty');
                    if (mode === 'all' || rowDiff === mode) {
                        row.style.display = '';
                        row.children[0].textContent = rank++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            };

            filterHighscores();
        });
    </script>
</x-layout>