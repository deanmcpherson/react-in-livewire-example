<?php

use function Livewire\Volt\{state};

Mingle::volt();

?>
<x-guest-layout>
@volt
    <script>
    function render(props) {
        return <div className=" border p-4 rounded-lg mt-2 bg-white text-black">
            I'm some other react component!
            </div>
    }
    </script>
@endvolt
</x-guest-layout>
