<x-layout>
    <div class="modes-container">
        <!-- easy mode -->
        <div class="mode-card">
            <h4><b>Easy Mode</b></h4>
            <a href="{{ route('memory-game.easy') }}"><strong>Spēlēt</strong></a>
        </div>

        <!-- medium mode -->
        <div class="mode-card">
            <h4><b>Medium Mode</b></h4>
            <a href="{{ route('memory-game.medium') }}"><strong>Spēlēt</strong></a>
        </div>

        <!-- hard mode -->
        <div class="mode-card">
            <h4><b>Hard Mode</b></h4>
            <a href="{{ route('memory-game.hard') }}"><strong>Spēlēt</strong></a>
        </div>
    </div>
</x-layout>
