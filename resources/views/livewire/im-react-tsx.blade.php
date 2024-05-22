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
    return <div className=" border p-4 rounded-lg mt-2">

       Hello {props.wire.hello} from react!
            <div>
                <button className="bg-red-200 m-2 p-2" onClick={() => {
                    props.wire.makeItGoBoom();
                }}>Go boom</button>
            </div>
            <div>
                <button onClick={doubleDown}>Double it! {props.wire.count}</button>
            </div>
            <Button />
        </div>
}
</script>
