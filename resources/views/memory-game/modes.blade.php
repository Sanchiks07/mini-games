<x-layout>
    <x-slot:title>
        Memory Game - Choose your mode
    </x-slot>

    <div class="modes-container">
        <!-- easy mode -->
        <div class="mode-card easy-mode">
            <button class="small-pretty" type="button" onclick="window.location='{{ route('memory-game.easy') }}'">Easy mode</button>
        </div>

        <!-- medium mode -->
        <div class="mode-card medium-mode">
            <button class="small-pretty" type="button" onclick="window.location='{{ route('memory-game.medium') }}'">Medium mode</button>
        </div>

        <!-- hard mode -->
        <div class="mode-card hard-mode">
            <button class="small-pretty" type="button" onclick="window.location='{{ route('memory-game.hard') }}'">Hard mode</button>
        </div>

        <!-- highscore board -->
         <div class="mode-card highscore" >
            <button class="small-pretty" type="button" onclick="window.location='{{ route('memory-game.highscore') }}'">Highscores</button>
        </div>
    </div>
</x-layout>
