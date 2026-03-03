class Animal {
    constructor(_name, _age){
        this.name = _name;
        this.age = _age;
    }

    sleep(){
        console.log('ZZZZZzZzZzZzZZz');
    }

    makeNoise(){
        console.log('Noises........');
    }

    roam(){
        console.log('Roaming: Roam');
    }
}
export default Animal;