// strings, numbers and booleans
let age = 100;
let age2 = age;
console.log(`age:${age}, age2:${age2}`);
age = 200;
console.log(`age:${age}, age2:${age2}`);
let name = "john";
let name2 = name;
console.log(`name:${name}, name2:${name2}`);
name = "doe";
console.log(`name:${name}, name2:${name2}`);

// arrays - shallow copy
const players = ["phobos", "sarge", "gunny"];
const team = players;
console.log(`players: ${players}, team: ${team}`);
team[3] = "Jade";
console.log(`players: ${players}, team: ${team}`);

// but let's copy via .slice()
const team2 = players.slice();
players[3] = "beltalowda"; //replace Jade from original, see what happens to team2 which is the copy via .slice()
console.log(`players:${players}\n`, `team:${team}\n`, `team2:${team2}\n`);

// concat
const team3 = [].concat(players);
team3[3] = "liang walker";
console.log(`team3:${team3}\n`);

// es6 'spread'
const team4 = [...players]; //this is the spread const newarray = [...old_array];
team4[3] = "nah fam";
console.log(`team4:${team4}\n`);

// array.from(oldarray)
const team5 = Array.from(players);
team5[3] = "silly bob";
console.log(`team5:${team5}`);

//OBJECTS - shallow copy
const person = {
    name: "john doe",
    age: 100,
};
console.log("person:");
console.log(person);

const another = person;
another.age = 99;
console.log("another:");
console.log(
    another,
    "therefore not a copy, just a reference to the same object"
);

const yet_another = Object.assign({}, person, { age: 98 });
console.log("yet_another");
console.log(yet_another);

// objects deep copy
const je = {
    name: "john doe",
    age: 35,
    hobbies: {
        one: "motocross",
        two: "flying",
    },
};
console.log(je);

const moi = Object.assign({}, je);
moi.hobbies.one = "whatever";
console.log(moi);

const me = JSON.parse(JSON.stringify(je));
me.hobbies.one = "motocross";
console.log(me);
