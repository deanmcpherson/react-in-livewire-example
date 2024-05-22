<?php

use function Livewire\Volt\{state};

Mingle::volt();

state([
    'hello' => 'world',
    'count' => 1,
]);

$makeItGoBoom = fn() => dd('This is dd');

$doubleIt = function() {
    $this->count *= 2;
};

?>
<script>
import {useState} from 'react';
import Button from '@/Button';

function render(props) {
    const doubleDown = () => {
        props.wire.doubleIt()
    }
    return <div className="flex flex-col gap-2">

        This is a test

            <button className="bg-red-200 m-2 p-2" onClick={() => {
                props.wire.makeItGoBoom();
            }}>Go boom</button>

            <button onClick={doubleDown}>Double it! {props.wire.count}</button>

            <Button />

        </div>
}
</script>
