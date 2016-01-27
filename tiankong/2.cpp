#include <cstdio>
void f(char* from, char* to)
{
	char* p_from = from;
	char* p_to = to;
	
	while(*p_from==' ' || *p_from=='\t' || *p_from=='\n') p_from++;
	
	do{
		if(*p_from==' ' || *p_from=='\t' || *p_from=='\n'){ 
			do{p_from++;} while(*p_from==' ' || *p_from=='\t' || *p_from=='\n');
			if(________) *p_to++ = ' ';
		}
	}while(*p_to++ = *p_from++);
}

void test(char* s)
{
	char buf[100];
	buf[0] = 0;
	f(s,buf); printf("%c%s%c\n",'|',buf,'|');
}

void myfunction()
{
	test("\t abc  \t   \n\n \t\t ");
	test("  \t\t a  b \t\t\t  c\t \n");
	test("\t \n   ");
}


int main()
{
	myfunction();
	return 0;
}