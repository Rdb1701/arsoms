function dec2bin(dec) {
    return (dec >>> 0).toString(2);
  }

  console.log(dec2bin(159));
  console.log(dec2bin(180));
  console.log(dec2bin(200));
  console.log(dec2bin(85));
  console.log(dec2bin(46));

function BinaryToDecimal(binary) {
  let decimal = 0;
  let binaryLength = binary.length;
  for (let i = binaryLength - 1; i >= 0; i--) {
   if (binary[i] == '1')
    decimal += Math.pow(2, binaryLength - 1 - i);
   }
   return decimal;
  }
 console.log(BinaryToDecimal("11111111"));
 console.log(BinaryToDecimal("01111111"));
 console.log(BinaryToDecimal("01010101"));
 console.log(BinaryToDecimal("10101100"));
 console.log(BinaryToDecimal("11100000"));