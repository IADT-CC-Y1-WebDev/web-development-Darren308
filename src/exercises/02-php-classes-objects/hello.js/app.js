let user = {
    firstName: 'Darren',
    lastName: 'Carroll',
    age: '20',
    hobbies: ['cinema', 25],
    friends: [
        {
        firstName: 'John',
        lastName: 'Fredrick',
        age: '25',    
        },
        {
        firstName: 'Jim',
        lastName: 'Fred',
        age: '25',    
        },
        
    ]
}

let donuts = ['chocolate','jam','custard'];

donuts.forEach((donut, i) => (
    // console.log(i + 1 + ' ' + donut)
    console.log(`Option ${i+1}: ${donut}`)
))