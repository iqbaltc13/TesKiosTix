package main

import (
	"fmt"
)

func checkNumber(bil int64) string {
	if bil%25 == 0 {
		return "KI"
	} else if bil%40 == 0 {
		return "OS"

	} else if bil%60 == 0 {
		return "TIK"

	} else if bil%99 == 0 {
		return "KIOSTIX"
	} else {
		return ""
	}
}

func main() {

	fmt.Println(checkNumber(50))
	fmt.Println(checkNumber(80))
	fmt.Println(checkNumber(180))
	fmt.Println(checkNumber(198))

}
