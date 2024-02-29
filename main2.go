package main

import (
	. "fmt"
	utlPkg "goapiPrj/lib"
	"reflect"
)

//   go get github.com/PaulXu-cn/goeval

// gin-swagger middleware
// swagger embed files
// 添加注释以描述 server 信息
// @title           Swagger Example API
// @version         1.0
// @description     This is a sample server celler server.
func main() {

	Println("hello22233")
	//	exec()

	utlPkg.Log3("3333")
	//utlPkg.Log3("测试第三方模块1133")
	//reflect.ValueOf(&t).MethodByName("Geeks").Call([]reflect.Value{})

	//fff()
	//CallFunc("Log", "执行Hello方法")

	//if ret, err := goeval.Eval(
	//	"",
	//	"fv := reflect.ValueOf(fff)",
	//	"fmt"); nil == err {
	//
	//	//fv := ret
	//	//	fv.Call([]reflect.Value{})
	//	//Print(string(ret))
	//	Print(ret)
	//} else {
	//	Print(err.Error())
	//}

	//expr, _ := govaluate.NewEvaluableExpression("fff")
	//result, _ := expr.Evaluate(nil)
	//Print(result)

	//------------this is ok
	fv := reflect.ValueOf(FF)
	fv.Call([]reflect.Value{})
}

func FF() {
	Println("ffffjout")
}
