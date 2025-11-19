<x-layout>
    <div class="games">
        <div class="memory-game">
            <button class="learn-more" type="button" onclick="window.location='{{ route('modes') }}'">Memory Game</button>
        </div>
        <div class="typing">
            <button class="learn-more" type="button" onclick="window.location='{{ route('typing') }}'">Typing speed</button>
        </div>
    </div>
</x-layout>
