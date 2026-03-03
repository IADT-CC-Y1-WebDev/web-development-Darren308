import Car from './classes/Car.js';

let bmw = new Car('BMW', '5 Series', 2026, 'Blue', ['HUD', 'Keyless']);
let bmw2 = new Car('BMW', '3 Series', 2025, 'Blue');
let audi = new Car('Audi', 'A5', 2025, 'Red');


let myCars = [bmw,bmw2,audi];

myCars.forEach((car) => {
    console.log(`${car}`);
});