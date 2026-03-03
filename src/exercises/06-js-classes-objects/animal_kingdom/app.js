import Cat from "./classes/Cat.js";
import Dog from "./classes/Dog.js";
import Lion from "./classes/Lion.js";
import Wolf from "./classes/Wolf.js";

let cat = new Cat("Tom", 2);
let dog = new Dog("Rover", 3);
let lion = new Lion("Tony", 5);
let wolf = new Wolf("Wolfie", 7);

let animals = [cat, dog, lion, wolf];

animals.forEach((animal) => {
  animal.makeNoise();
  animal.roam();
  animal.sleep();
  console.log("==========");
});