<x-layout>
    <x-slot:title>
        Memory Game Highscores
    </x-slot>

    <div class="highscore-container">
        <h1>Memory Game Highscores</h1>
        <br>
        <select class="highscore-select" id="highscoreModeSelect" onchange="filterHighscores()">
            <option value="all">All Modes</option>
            <option value="easy">Easy Mode</option>
            <option value="medium">Medium Mode</option>
            <option value="hard">Hard Mode</option>
        </select>
        <br>
        <table class="highscore-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Mode</th>
                    <th>Time (seconds)</th>
                </tr>
            </thead>
            <tbody id="highscoreTableBody">
                @foreach($highscores as $index => $score)
                    <tr data-mode="{{ $score->mode }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $score->user->name }}</td>
                        <td>{{ ucfirst($score->mode) }}</td>
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
                    const rowMode = (row.getAttribute('data-mode') || '').toLowerCase();
                    if (mode === 'all' || rowMode === mode.toLowerCase()) {
                        row.style.display = '';
                        const rankCell = row.querySelector('td');
                        if (rankCell) rankCell.textContent = rank++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            };

            // Run once on load to ensure ranks are consistent
            filterHighscores();
        });
    </script>
</x-layout>