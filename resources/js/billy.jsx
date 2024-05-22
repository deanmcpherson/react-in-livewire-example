import React from 'react'

function billy({wire, ...props}) {

    const message = props.mingleData.message

    console.log(message, wire) // 'Message in a bottle 🍾'



    return (
        <div onClick={() => {
            wire.makeItGoBoom(123)
        .then(data => {
            console.log(data) // 4
        })
        }}>
            Nice!!
            {/* <!-- Create something great! --> */}
        </div>
    )
}

export default billy
