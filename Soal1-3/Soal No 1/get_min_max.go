package main

import (
	"fmt"
	"strings"
)

func isPalindrome(sentence string) interface{} {
	if sentence == balikString(sentence) {
		return true
	}
	return false
}

func balikString(sentence string) (result string) {
	for _, v := range sentence {
		result = string(v) + result
	}
	return result
}

func main() {
	var sentence string
	fmt.Print("Masukkan tulisan: ")
	fmt.Scan(&sentence)
	if isPalindrome(strings.ToUpper(sentence)) == true {
		fmt.Println("Palindrome")
	} else {
		fmt.Println("Bukan palindrome")
	}
}
