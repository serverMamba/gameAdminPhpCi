#!/bin/sh
package_name=$1
prefix='com.liuliugame1.'
cd /home/houtai/www/push_pem/tmp
if [ -f "${prefix}${package_name}.cer" -a -f "${prefix}${package_name}.p12" ];then
	openssl x509 -in ${prefix}${package_name}.cer -inform der -out ${package_name}.pem
	openssl pkcs12 -nocerts -out ${package_name}_key.pem -in ${prefix}${package_name}.p12
	cat ${package_name}.pem ${package_name}_key.pem > ${prefix}${package_name}.pem
	mv ${prefix}${package_name}.pem ../
	echo 'success'
else
	echo 'cer not exist'
fi